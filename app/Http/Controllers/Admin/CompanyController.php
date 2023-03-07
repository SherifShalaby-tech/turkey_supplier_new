<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Plan;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
class CompanyController extends Controller
{

    public function index()
    {
        return view('Admin.company.index');
    }
    public function data() {
        $companies = Company::where('trade_role','seller')->select();
        return DataTables::of($companies)->smart(true)
        ->addIndexColumn()
         ->addColumn('actions', function (Company $company) {
             return view('Admin.company.data_table.actions',compact('company'));
         })
         ->editColumn('updated_at', function (Company $company) {
            return $company->updated_at->format('Y-m-d');
        })
        ->editColumn('created_at', function (Company $company) {
            return $company->created_at->format('Y-m-d');
        })
        ->addColumn('phonecode', function (Company $company) {
            return $company->phone .' '. $company->cod ;
        })
        ->addColumn('status', function (Company $company) {
            return view('Admin.company.data_table.status', compact('company'));
        })
        ->rawColumns(['datatable'])
        ->toJson();
    }
    public function create()
    {
        $plans= Plan::all();
        return view('Admin.company.create',compact('plans'));
    }
    public function store(CompanyRequest $request)
    {
    DB::beginTransaction();
   try {
        $request->validated();
        $company = new Company();
        if(!empty($request->translations))
        {
            $company->translation = $request->translations;
        }else{
            $company->translation=[];
        }
        $company->name = $request->name;
        $company->plan_id = $request->plan_id??null;
        $company->email = $request->email;
        // $company->cod = $request->cod ;
        $company->cod = $request->cod;
        $company->phone = $request->phone;
        $company->phone1 = $request->phone1;
        $company->phone2 = $request->phone2;
        $company->phone3 = $request->phone3;
        $company->country = $request->country;
        $company->description = $request->description;
        $company->type = 'company';
        $company->password = bcrypt($request->password);
        $company->trade_role = 'seller';
        $company->agree = 1;
        $company->admin_add = Auth::user()->name ?? '';
        $company->save();
        $company->attachRole('company');
        $pro = Company::where('id',$company->id)->update([
            'namear' => $company->translation['name']['ar']??null,
            'nameen' => $company->translation['name']['en']??null,
            'nametr' => $company->translation['name']['tr']??null,
            'descar' => $company->translation['description']['ar']??null,
            'descen' => $company->translation['description']['en']??null,
            'desctr' => $company->translation['description']['tr']??null,
         ]);
        if ($request->images && count($request->images) > 0) {
            $i = 1;
            if(auth('company')->user()){
                if (count($request->images) > auth('company')->user()->plan?->company_picture_count){
                    Alert::error('error msg',trans('custom.plan_validation_3'));
                    return redirect()->back();
                }
            }else{
                $company_id = Company::where('id',$company->id)->first();
                if (count($request->images) > $company_id->plan?->company_picture_count){
                    Alert::error('error message',trans('custom.plan_validation_3'));
                    return redirect()->back();
                }
            }
            foreach ($request->images as $image) {
                $file_name = Str::slug($request->name ) . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('images/companies/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $company->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);
                $i++;
            }
        }
        DB::commit();
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->route('admin.companies.index');
   } catch (\Exception $exception) {
       DB::rollback();
       Alert::error('error msg', $exception->getMessage());
       return redirect()->back();
       //    return redirect()->back()->withErrors(['Error' => $exception->getMessage()]);
   }
    }
    public function edit(Company $company)
    {
        $plans= Plan::all();
        return view('Admin.company.edit',compact('company','plans'));
    }
    public function update(CompanyRequest $request)
    {
        // dd($request->all());
        // dd(Str::slug($request->name ));
        DB::beginTransaction();
            try {
            $request->validated();
            $company = Company::where('id',$request->id)->first();
            // if($request->image){
            //     $filename = time().'.'.$request->image->extension();
            //     $request->image->move(public_path('images/categories/'), $filename);
            //     $company->image = $filename;
            // }
            if(!empty($request->translations))
            {
                $company->translation = $request->translations;
            }else{
                $company->translation=[];
            }
            $company->description = $request->description;
            $company->plan_id = $request->plan_id;
            $company->name = $request->name;
            $company->email = $request->email;
            $company->cod = $request->cod;
            $company->phone = $request->phone ;
            $company->phone1 = $request->phone1;
            $company->phone2 = $request->phone2;
            $company->phone3 = $request->phone3;
            $company->country = $request->country;
            if(trim($request->password) != ''){
                $company->password = bcrypt($request->password);
            }
            $company->admin_edit = Auth::user()->name;
            $company->namear = $company->translation['name']['ar']??null;
            $company->nameen = $company->translation['name']['en']??null;
            $company->nametr = $company->translation['name']['tr']??null;
            $company->descar = $company->translation['description']['ar']??null;
            $company->descen = $company->translation['description']['en']??null;
            $company->desctr = $company->translation['description']['tr']??null;
            $company->save();
            if ($request->images && count($request->images) > 0) {
                $i = $company->media()->count() + 1;
                if(auth('company')->user()){
                    if (count($request->images) > auth('company')->user()->plan->company_picture_count && count($request->images) > $company->media()->count()){
                        Alert::error('error msg',trans('custom.plan_validation_3'));
                        return redirect()->back();
                    }
                }else{
                    $company_id = Company::where('id',$company->id)->first();
                    if (count($request->images) > $company_id->plan->company_picture_count && count($request->images) > $company->media()->count()){
                        Alert::error('error message',trans('custom.plan_validation_3'));
                        return redirect()->back();
                    }
                }
                foreach ($request->images as $image) {
                    $file_name = Str::slug($company->name ) . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('images/companies/' . $file_name);
                    Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);
                    $company->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            return redirect()->route('admin.companies.index');
            // return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollback();
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }
    public function destroy(Request $request,Company $company)
    {
        try {
            // $company = Company::where('id', $request->id)->first();
            if ($company->media()->count() > 0) {
                foreach ($company->media as $media) {
                    if (File::exists(public_path('images/company/' . $media->file_name))) {
                        unlink('images/company/' . $media->file_name);
                    }
                    $media->delete();
                }
            }
            $company->delete();
            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }
    public function remove_image(Request $request)
    {
        $company = Company::findOrFail($request->company_id);
        $image = $company->media()->whereId($request->image_id)->first();
        if (File::exists('images/company/' . $image->file_name)) {
            unlink('images/company/' . $image->file_name);
        }
        $image->delete();
        return true;
    }
    public function upload_image(Request $request)
    {
        dd($request->company_id);
        $company = Company::findOrFail($request->company_id);
        // $image = $company->media()->whereId($request->image_id)->first();
        // if (File::exists('images/company/' . $image->file_name)) {
        //     unlink('images/company/' . $image->file_name);
        // }
        // $image->delete();
        // return true;
    }

    public function showdata($id)
    {
        // dd($id);
        try {
            $company = Company::with('products','plan','firstMedia')
            ->whereId($id)->first();
            return view('Admin.company.show',compact('company'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }


    public function change_status($id)
    {
        $adminID = Crypt::decrypt($id);
        $admin = Company::findorfail($adminID);
        ($admin->status == '1') ? $admin->status = 0 : $admin->status = 1;
        $admin->update();
        Alert::success(trans('admins.success'),trans('admins.change-succes'));
        return redirect()->back();
    }
}
