<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Company;
use App\Models\Plan;
use App\Models\Plancheckout;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class PlancheckoutController extends Controller
{

    public function index()
    {
        return view('Admin.plancheckout.index');
    }
    public function data() {
        $plancheckouts = Plancheckout::with('company','plan')->select();
        return DataTables::of($plancheckouts)
        ->addIndexColumn()
         ->addColumn('actions', function (Plancheckout $plancheckout) {
             return view('Admin.plancheckout.datatable.actions',compact('plancheckout'));
         })
        ->editColumn('created_at', function (Plancheckout $plancheckout) {
            return $plancheckout->created_at->format('Y-m-d');
        })
        ->addColumn('company', function (Plancheckout $plancheckout) {
            return $plancheckout->company?->name;
        })
        ->addColumn('plan', function (Plancheckout $plancheckout) {
            return $plancheckout->plan?->title;
        })
        ->addColumn('oldprice', function (Plancheckout $plancheckout) {
            if($plancheckout->oldusdprice){
                return $plancheckout?->oldusdprice . ' $ ' .' ==> ' . $plancheckout?->oldltprice. ' lt ';
            }
        })
        ->addColumn('newprice', function (Plancheckout $plancheckout) {
            return $plancheckout?->usdprice . ' $ '.' ==> ' . $plancheckout?->ltprice. ' lt ';
        })
        ->editColumn('total', function (Plancheckout $plancheckout) {
            return number_format($plancheckout?->total,2). ' lt ';
        })
        ->addColumn('status', function (Plancheckout $plancheckout) {
            return view('Admin.plancheckout.datatable.status', compact('plancheckout'));
        })
        ->rawColumns(['actions'])
        ->toJson();
    }


    public function destroy($id)
    {
        $plan = Plancheckout::where('id',$id)->first();
        // if($plan->image != null && file_exists(public_path('/images/plancheckout/' . $plan->image))){
        //     unlink('images/plancheckout/' . $plan->image);
        // }
        if($plan->file != null && file_exists(public_path('/Attachments/plan/' . $plan->file))){
            unlink('Attachments/plan/' . $plan->file);
        }
        $plan->delete();
        Alert::success(trans('admins.success'),trans('admins.change-succes'));
        return redirect()->back();
    }

    public function change_status($id)
    {
        $planID = Crypt::decrypt($id);
        $plan = Plancheckout::findorfail($planID);
        ($plan->status == '1') ? $plan->status = 0 : $plan->status = 1;
        $plan->update();
        $company = Company::where('id',$plan->company_id)->first();
        if($company->status == false){
            ($company->status == '1') ? $company->status = 0 : $company->status = 1;
        }

        $company->plan_id = $plan->plan_id;
        $company->update();

        Alert::success(trans('admins.success'),trans('admins.change-succes'));
        return redirect()->back();
    }

    public function showdata($id)
    {
        // dd($id);
        try {
            $plancheckout = Plancheckout::with('company','plan')->whereId($id)->first();
            return view('Admin.plancheckout.show',compact('plancheckout'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

}
