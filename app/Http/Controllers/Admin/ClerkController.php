<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ClerkRequest;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Clerk;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
class ClerkController extends Controller
{
    protected $models = ['home','product','contactsuppliers'];
    protected $permissionMaps = ['create', 'read', 'update', 'delete'];
    public function __construct()
    {
        $this->middleware('permission:read_clerks')->only(['index']);
        $this->middleware('permission:create_clerks')->only(['create', 'store']);
        $this->middleware('permission:update_clerks')->only(['edit', 'update']);
        $this->middleware('permission:delete_clerks')->only(['delete']);

    }// end of __construct
    public function index(){
         if(auth('company')->user() && (auth('company')->user()->plan->id <= 0 || auth('company')->user()->status != true)){
                Alert::error('error message', trans('custom.Please activate your account or subscribe to a plan first'));
                    return redirect()->route('admin.home');
         } 
        return view('Admin.clerks.index');
    }
    public function data() {
        if (auth('admin')->user()) {
            $clerks = Clerk::with(['company'])->select();
        }
        if (auth('company')->user()) {
            $clerks = Clerk::with(['company'])
            ->where('company_id', Auth::guard('company')->user()->id)
            ->select();
        }
        return DataTables::of($clerks)
        ->addIndexColumn()
        ->editColumn('created_at', function (Clerk $clerk) {
            return $clerk->created_at->format('Y-m-d');
        })
        ->addColumn('status', function (Clerk $clerk) {
            return view('Admin.clerks.data_table.status', compact('clerk'));
        })
        ->addColumn('company', function (Clerk $clerk) {
            return $clerk->company?->name;
        })
        // ->addColumn('image', function (Clerk $clerk) {
        //     return view('Admin.clerks.data_table.image', compact('clerk'));
        // })
        ->addColumn('actions', function (Clerk $clerk) {
            return view('Admin.clerks.data_table.actions',compact('clerk'));
            // return $clerk->id;
        })
        ->rawColumns(['actions'])
        ->toJson();
    }

    public function create()
    {
         if(auth('company')->user() && (auth('company')->user()->plan->id <= 0 || auth('company')->user()->status != true)){
                Alert::error('error message', trans('custom.Please activate your account or subscribe to a plan first'));
                    return redirect()->route('admin.home');
         } 
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        $companies = Company::where('trade_role','seller')->get();
        return view('Admin.clerks.create',compact('companies','models','permissionMaps'));
    }
    public function store(ClerkRequest $request)
    {
        try{
            $input = $request->except(['password','password_confirmation','permissions']);
            $input['email_verified_at'] = now();
            $input['password'] = bcrypt($request->password);
            $clerk = Clerk::create($input);
            $clerk->syncPermissions($request->permissions);
            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect()->route('admin.clerks.index');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function edit(Clerk $clerk)
    {
         if(auth('company')->user() && (auth('company')->user()->plan->id <= 0 || auth('company')->user()->status != true)){
                Alert::error('error message', trans('custom.Please activate your account or subscribe to a plan first'));
                    return redirect()->route('admin.home');
         } 
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        $companies = Company::where('trade_role','seller')->get();
        return view('Admin.clerks.edit',compact('clerk','companies','models','permissionMaps'));
    }
    public function update(ClerkRequest $request, Clerk $clerk)
    {
        $input = $request->except(['password','password_confirmation','permissions']);
        if(trim($request->password) != ''){
            $input['password'] = bcrypt($request->password);
        }
        $clerk->update($input);
        $clerk->syncPermissions($request->permissions);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->route('admin.clerks.index');
    }

    public function destroy(Clerk $clerk)
    {
        $clerk->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }

    public function change_status($id)
    {
        $clerkID = Crypt::decrypt($id);
        $clerk = Clerk::findorfail($clerkID);
        ($clerk->status == '1') ? $clerk->status = 0 : $clerk->status = 1;
        $clerk->update();
        Alert::success(trans('admins.success'),trans('admins.change-succes'));
        return redirect()->back();
    }
}
