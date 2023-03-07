<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactSupplierRequest;
use App\Http\Requests\Website\contact_supplier;
use App\Mail\VisitorMail;
use App\Models\Company;
use App\Models\ContactSupplier;
use App\Models\Product;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactSupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_contactsuppliers')->only(['index']);
        $this->middleware('permission:create_contactsuppliers')->only(['create', 'store']);
        $this->middleware('permission:update_contactsuppliers')->only(['edit', 'update']);
        $this->middleware('permission:delete_contactsuppliers')->only(['delete']);

    }// end of __construct
    public function index()
    {
        if (auth('company')->user()) {
            $contactSuppliers = ContactSupplier::where('supplier_id', Auth::guard('company')->user()->id)->latest()->paginate(10);
        }
        if (auth('clerk')->user()) {
            $contactSuppliers = ContactSupplier::where('supplier_id', Auth::guard('clerk')->user()->company_id)->latest()->paginate(10);
        }
        // $contactSuppliers = ContactSupplier::latest()->paginate(10);
        return view('Admin.contact_supplier.index',compact('contactSuppliers'));
    }
    public function store(contact_supplier $request){
        //  dd($request->all());
        //  Alert::success(trans('admins.success'), trans('admins.add-succes'));
        //  return redirect()->back();
        // try{
            // الرد على رساله الناس الى مسجله كمشترى
            $request->validated();
            if($request->supplier_id == $request->user_id){
                Alert::error('error msg','Error');
                return redirect()->back();
            }else{
                  if($request->user_id ){
                    if(auth('company')->user()){
                        $contact_supplier = new ContactSupplier();
                        if($request->file('file')){
                            $filename = md5($request->file . microtime()) . '.' . $request->file->extension();
                            $request->file->move(public_path('Attachments/'), $filename);
                            $contact_supplier->file = $filename;
                        }
                        $contact_supplier->user_id        = Auth::guard('company')->user()->id;   // الشركه البائع
                        $contact_supplier->name           = Auth::guard('company')->user()->name;
                        $contact_supplier->email          = Auth::guard('company')->user()->email;
                        $contact_supplier->product_id     = $request->product_id;
                        $contact_supplier->supplier_id    = $request->user_id;     // المشترى
                        $contact_supplier->message        = $request->message;
                        $contact_supplier->subject        = $request->subject;
                        $contact_supplier->save();

                    }elseif(auth('clerk')->user()){
                        $contact_supplier = new ContactSupplier();
                        if($request->file('file')){
                            $filename = md5($request->file . microtime()) . '.' . $request->file->extension();
                            $request->file->move(public_path('Attachments/'), $filename);
                            $contact_supplier->file = $filename;
                        }
                        $contact_supplier->user_id        = Auth::guard('clerk')->user()->company_id;   // موظف الشركه
                        $contact_supplier->name           = Auth::guard('clerk')->user()->name;
                        $contact_supplier->email          = Auth::guard('clerk')->user()->email;
                        $contact_supplier->product_id     = $request->product_id;
                        $contact_supplier->supplier_id    = $request->user_id;     // المشترى
                        $contact_supplier->message        = $request->message;
                        $contact_supplier->subject        = $request->subject;
                        $contact_supplier->save();
                    }
                  }else{
                    // send email to visitor
                    // dd($request->visitor_id);

                    if(auth('company')->user()){
                        $contact_supplier = new ContactSupplier();
                        if($request->file('file')){
                            $filename = md5($request->file . microtime()) . '.' . $request->file->extension();
                            $request->file->move(public_path('Attachments/'), $filename);
                            $contact_supplier->file = $filename;
                        }
                        $contact_supplier->user_id        = Auth::guard('company')->user()->id;   // الشركه البائع
                        $contact_supplier->name           = Auth::guard('company')->user()->name;
                        $contact_supplier->email          = Auth::guard('company')->user()->email;
                        $contact_supplier->product_id     = $request->product_id;
                        // $contact_supplier->supplier_id    = $request->visitor_id;     // المشترى
                        $contact_supplier->visitor_id    = $request->visitor_id;     // الزائر
                        $contact_supplier->message        = $request->message;
                        $contact_supplier->subject        = $request->subject;
                        $contact_supplier->save();
                        $visitor = Visitor::whereId($request->visitor_id)->first();
                        Mail::to($visitor->email)->send(new VisitorMail($visitor,$contact_supplier));

                    }elseif(auth('clerk')->user()){
                        $contact_supplier = new ContactSupplier();
                        if($request->file('file')){
                            $filename = md5($request->file . microtime()) . '.' . $request->file->extension();
                            $request->file->move(public_path('Attachments/'), $filename);
                            $contact_supplier->file = $filename;
                        }
                        $contact_supplier->user_id        = Auth::guard('clerk')->user()->company_id;   // موظف الشركه
                        $contact_supplier->name           = Auth::guard('clerk')->user()->name;
                        $contact_supplier->email          = Auth::guard('clerk')->user()->email;
                        $contact_supplier->product_id     = $request->product_id;
                        // $contact_supplier->supplier_id    = $request->visitor_id;     // المشترى
                        $contact_supplier->visitor_id    = $request->visitor_id;     // الزائر
                        $contact_supplier->message        = $request->message;
                        $contact_supplier->subject        = $request->subject;
                        $contact_supplier->save();

                        $visitor = Visitor::whereId($request->visitor_id)->first();
                        Mail::to($visitor->email)->send(new VisitorMail($visitor,$contact_supplier));
                        // if( $contact_supplier->file){
                        //     $files =  [public_path('/Attachments/'.$contact_supplier->file)];
                        // }
                        // Mail::send('emails.visitoremail', $visitor,$contact_supplier, function($message)use($contact_supplier,$visitor, $files) {
                        //     $message->to($visitor->email)
                        //             ->subject(__('email.welcomesms') . ' ' . $visitor->name);
                        //             // ->with([
                        //             //     // 'visitor' => $visitor,
                        //             //     'contact_supplier' => $contact_supplier,
                        //             // ]);

                        //     foreach ($files as $file){
                        //         $message->attach($file);
                        //     }
                        // });

                    }
                  }
            }
            Alert::success(trans('contactSuppliers.success'),trans('contactSuppliers.smsendbuyer'));
            return redirect()->back();
    //    }catch (\Exception $exception){
    //        Alert::error('error msg',$exception->getMessage());
    //        return redirect()->back();
    //    }
    }
    public function destroy(ContactSupplier $ContactSupplier)
    {
        $ContactSupplier->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
    public function showdata($id)
    {
        try {
            $contactSupplier = ContactSupplier::with('supplier','user')->whereId($id)->first();
            return view('Admin.contact_supplier.show',compact('contactSupplier'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }


    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $admins_ids) {
                    $admin = ContactSupplier::findorfail($admins_ids);
                    if($admin->file != null && file_exists(public_path('/Attachments/' . $admin->file))){
                        unlink('Attachments/' . $admin->file);
                    }
                }
            } else {
                // Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                Alert::success(trans('contactSuppliers.fail'),trans('contactSuppliers.failsms'));
                return redirect()->back();
            }
            ContactSupplier::destroy($delete_select_id);
            // Alert::success('all data deleted successfully', 'admins deleted successfully');
            Alert::success(trans('contactSuppliers.success'),trans('contactSuppliers.deleteall'));
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
