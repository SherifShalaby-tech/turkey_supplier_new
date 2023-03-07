<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use App\Models\Company;
use App\Models\ContactSupplier;
use App\Models\Product;
use App\Models\Visitor;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_reports')->only(['index']);
        $this->middleware('permission:create_reports')->only(['create', 'store']);
        $this->middleware('permission:update_reports')->only(['edit', 'update']);
        $this->middleware('permission:delete_reports')->only(['delete']);

    }// end of __construct
    public function reports()
    {
        return view('Admin.reports.index');
    }
    public function reportsdata()
    {
        $companys = Company::with('plan','products')->where('trade_role','seller')->select();
        return DataTables::of($companys)->smart(true)
        ->addIndexColumn()
        ->editColumn('created_at', function (Company $company) {
            return $company->created_at->format('Y-m-d');
        })
        ->editColumn('updated_at', function (Company $company) {
            return $company->updated_at->format('Y-m-d');
        })
        ->addColumn('plan', function (Company $company) {
            return $company->plan?->title;
        })
        ->addColumn('fees', function (Company $company) {
            return $company->plan?->price;
        })
        ->addColumn('productcount', function (Company $company) {
            return $company->products?->count();
        })
        ->addColumn('productvisit', function (Company $company) {
            return Product::where('company_id',$company->id)->sum('views');
        })
        ->addColumn('companysendsms', function (Company $company) {
            return ContactSupplier::where('supplier_id',$company->id)->count('message');
        })
        ->addColumn('companyreceivesms', function (Company $company) {
            return ContactSupplier::where('user_id',$company->id)->count('message');
        })
        ->rawColumns(['actions'])
        ->toJson();
    }
    public function buyerreports()
    {
        return view('Admin.reports.buyereport');
    }

    public function buyerreportsdata()
    {
        $companys = Company::with('plan','products')->where('trade_role','buyer')->select();
        return DataTables::of($companys)->smart(true)
        ->addIndexColumn()
        ->editColumn('created_at', function (Company $company) {
            return $company->created_at->format('Y-m-d');
        })
        ->editColumn('updated_at', function (Company $company) {
            return $company->updated_at->format('Y-m-d');
        })
        ->addColumn('clientsendsms', function (Company $company) {
            return ContactSupplier::where('supplier_id',$company->id)->count('message');
        })
        ->addColumn('clientreceivesms', function (Company $company) {
            return ContactSupplier::where('user_id',$company->id)->count('message');
        })
        ->rawColumns(['actions'])
        ->toJson();
    }

    public function visitoreports()
    {
        return view('Admin.reports.visitoreport');
    }

    public function visitoreportsdata()
    {
        $visitors = Visitor::select();
        return DataTables::of($visitors)->smart(true)
        ->addIndexColumn()
        ->editColumn('created_at', function (Visitor $visitor) {
            return $visitor->created_at->format('Y-m-d');
        })
        ->editColumn('address', function (Visitor $visitor) {
            return $visitor->contactsuppliers?->address;
        })
        ->addColumn('clientsendsms', function (Visitor $visitor) {
            return ContactSupplier::where('supplier_id',$visitor->id)->count('message');
        })
        ->addColumn('clientreceivesms', function (Visitor $visitor) {
            return ContactSupplier::where('visitor_id',$visitor->id)->count('message');
        })
        ->rawColumns(['actions'])
        ->toJson();
    }

}
