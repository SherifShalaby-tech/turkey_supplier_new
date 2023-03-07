<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\Plancheckout;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
class PlanController extends Controller
{

    public function index()
    {
        return view('Admin.plan.index');
    }
    public function data() {
        $plans = Plan::select();
        return DataTables::of($plans)
        ->addIndexColumn()
         ->addColumn('actions', function (Plan $plan) {
             return view('Admin.plan.data_table.actions',compact('plan'));
         })
            ->editColumn('created_at', function (Plan $Plan) {
                return $Plan->created_at->format('Y-m-d');
            })
         ->rawColumns(['actions'])
            ->toJson();
    }
    public function create()
    {
        return view('Admin.plan.create');
    }
    public function store(PlanRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
            $path = public_path('images/plans/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        $input['title'] = $request->title;
        $input['character_count'] = $request->character_count;
        $input['company_picture_count'] = $request->company_picture_count;
        $input['product_count'] = $request->product_count;
        $input['product_picture_count'] = $request->product_picture_count;
        $input['video_time'] = $request->video_time;
        $input['video_count'] = $request->video_count;
        $input['price'] = $request->price;
        $input['speacial_customer'] = $request->speacial_customer;
        Plan::create($input);
        Alert::success('success', 'تم الإضافة بنجاح');
        return redirect()->route('admin.plans.index');
    }
    public function edit(Plan $plan)
    {
        return view('Admin.plan.edit',compact('plan'));
    }
    public function update(PlanRequest $request, Plan $Plan)
    {
        if ($image = $request->file('image')) {
            if($Plan->image != null && file_exists(public_path('images/plans/' . $Plan->image))){
                unlink(public_path('images/plans/' . $Plan->image));
            }
            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
            $path = $path = public_path('images/plans/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        $input['title'] = $request->title;
        $input['character_count'] = $request->character_count;
        $input['company_picture_count'] = $request->company_picture_count;
        $input['product_count'] = $request->product_count;
        $input['product_picture_count'] = $request->product_picture_count;
        $input['video_time'] = $request->video_time;
        $input['video_count'] = $request->video_count;
        $input['price'] = $request->price;
        $input['speacial_customer'] = $request->speacial_customer;
        $Plan->update($input);
        Alert::success('success', 'تم التعديل بنجاح');
        return redirect()->route('admin.plans.index');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        Alert::success(trans('admins.success'),trans('admins.change-succes'));
        return redirect()->back();
    }


    public function checkout(Plan $plan){
        // dd($plan->price);
    $planpriceusd = $plan->price; //  125$   250$  500$
    $setting = Setting::first() ;
    $rate    = $setting->profit_percent ;  //19
    $rateusd = $rate *  $planpriceusd;    // 19 * 125$ = 22361tl

    // $rate = $setting->rate;
    // Auth::user()->plan->id == 1 &&
    if ( Auth::user()->status == true){
        $planx = Plancheckout::where('company_id',Auth::user()->id)->latest()->first();
        $oldprice = $planx->ltprice ;
        $newprice = $rateusd;
        $total = $newprice - $oldprice ;
    }elseif(Auth::user()->plan->id == 1 && Auth::user()->status == false){
        $oldprice = Plancheckout::where('company_id',Auth::user()->id)->first();
        $oldprice =  $rateusd;
        $newprice = 0;
        $total = $oldprice ;
    }
    $ipan = $setting->ipan;
    $company = Auth::user();
      return view('Admin.plan.checkout',compact('plan','company','rateusd','ipan','oldprice','newprice','total','setting'));
    }

    public function checkoutorder(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'image' => 'required',
            'idnum' => 'nullable',
        ]);
        if($request->file('image')){
            $filename = md5($request->image . microtime()) . '.' . $request->image->extension();
            $request->image->move(public_path('Attachments/plan/'), $filename);
            $data['image'] = $filename;
        }
        $data['company_id'] = Auth::user()->id;
        $data['plan_id'] = $request->planid;
        if (Auth::user()->plan->id == 1 || Auth::user()->plan->id == 2){
            $data['oldusdprice'] = $request->oldusdprice;
            $data['oldltprice'] = $request->oldltprice;
        }
        $data['usdprice'] = $request->usdprice;
        $data['ltprice'] = $request->ltprice;
        $data['total'] = $request->total;
        $data['ipan'] = $request->ipan;
        $data['idnum'] = $request->idnum ?? null;
        // dd($request->all());
        Plancheckout::create($data);
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->route('admin.home');

    }
}
