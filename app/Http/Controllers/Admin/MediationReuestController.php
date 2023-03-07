<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\MediationRequest\Store;
use App\Models\Company;
use App\Models\MediationOrder;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MediationReuestController extends Controller
{
    public function index(){
        try{
            return view('Admin.mediation_requests.index');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function data() {
        $mediation_requests = MediationOrder::select();
        return DataTables::of($mediation_requests)
            ->addIndexColumn()
            ->editColumn('created_at', function (MediationOrder $mediation_requests) {
                return $mediation_requests->created_at->format('Y-m-d');
            })
            ->editColumn('company_id', function (MediationOrder $mediation_requests) {
                return $mediation_requests->company->name;
            })
            ->editColumn('product_id', function (MediationOrder $mediation_requests) {
                return $mediation_requests->product->name;
            })
            ->editColumn('qty', function (MediationOrder $mediation_requests) {
                return $mediation_requests->qty ?? '-';
            })
            ->editColumn('country_address', function (MediationOrder $mediation_requests) {
                return $mediation_requests->country_address ?? '-';
            })
            ->editColumn('details', function (MediationOrder $mediation_requests) {
                return $mediation_requests->details ?? '-';
            })
            ->addColumn('actions', function (MediationOrder $mediation_requests) {
                return view('Admin.mediation_requests.datatable.actions',compact('mediation_requests'));
            })
            ->rawColumns(['image','actions'])
            ->toJson();
    }

    public function create(){
        $companies = Company::get(['id','name']);
        $products = Product::get(['id','name']);
        return view('Admin.mediation_requests.create',compact('companies','products'));
    }

    public function store(Store $request){
        try{
            toast('send success','success');
            $request->validated();
            $mediation_requests = new MediationOrder();
            $mediation_requests->name = $request->name;
            $mediation_requests->company_id = $request->company_id;
            $mediation_requests->product_id = $request->product_id;
//            $mediation_requests->company_name = $request->company_name;
            $mediation_requests->phone = $request->phone;
            $mediation_requests->country_address =$request->country ;
//            $mediation_requests->product_name = $request->product_name;
//            $mediation_requests->product_desc =$request->product_desc;
            $mediation_requests->qty = $request->qty;
            $mediation_requests->supply_period =$request->supply_period;
            $mediation_requests->save();
            return redirect(route('admin.MediationRequest.index'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id){
        try{
            $mediation = MediationOrder::where('id',$id)->first();
            $companies = Company::get(['id','name']);
            $products = Product::get(['id','name']);
            return view('Admin.mediation_requests.edit',compact('companies','products','mediation'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request){
        try{
            toast('updated success','success');
            $mediation = MediationOrder::where('id',$request->id)->first();
            $mediation->name = $request->name;
            $mediation->company_id = $request->company_id;
            $mediation->product_id = $request->product_id;
            $mediation->phone = $request->phone;
            $mediation->country_address =$request->country ;
            $mediation->qty = $request->qty;
            $mediation->supply_period =$request->supply_period;
            $mediation->save();
            return redirect(route('admin.MediationRequest.index'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        try{
            toast('deleted success','success');
            $mediation_requests = MediationOrder::where('id',$request->id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
