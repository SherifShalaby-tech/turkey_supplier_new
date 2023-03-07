<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
class AdminController extends Controller
{
    protected $models = [
                         'admins','company','clerks','categories','sub_categories',
                         'product','mediationorder','service','translationServices','ads',
                         'colors','sizes','leadtimes','plans','about_us',
                         'tradeshows','helpcenters','polices','home','settings',
                         'contactus','reports','orders','mediations','shipment_order_news',
                         'chats','translations','newcat',
                        ];
    protected $permissionMaps = ['create', 'read', 'update', 'delete'];
    public function __construct()
    {
        $this->middleware('permission:read_admins')->only(['index']);
        $this->middleware('permission:create_admins')->only(['create', 'store']);
        $this->middleware('permission:update_admins')->only(['edit', 'update']);
        $this->middleware('permission:delete_admins')->only(['delete']);

    }// end of __construct
    public function index(){
        return view('Admin.admins.index');
    }
    // public function employee(){
    //     return view('Admin.admins.employee');
    // }
    public function data() {
        $admins = Admin::select();
        return DataTables::of($admins)
        ->addIndexColumn()
        ->editColumn('created_at', function (Admin $admin) {
            return $admin->created_at->format('Y-m-d');
        })
        // ->addColumn('type', function (Admin $admin) {
        //     return view('Admin.admins.datatable.types', compact('admin'));
        // })
        ->addColumn('status', function (Admin $admin) {
            return view('Admin.admins.data_table.status', compact('admin'));
        })
        ->addColumn('actions', function (Admin $admin) {
            return view('Admin.admins.data_table.actions',compact('admin'));
        })
        // ->addColumn('roles_name', function (Admin $admin) {
        //     return view('Admin.admins.data_table.permissionLevel', compact('admin'));
        // })
        ->rawColumns(['actions'])
        ->toJson();
    }
    // public function employeeData() {
    //     $admins = Admin::orderByDesc('created_at')->whereType('employee')->select();
    //     return DataTables::of($admins)
    //     ->addIndexColumn()
    //     ->editColumn('created_at', function (Admin $admin) {
    //         return $admin->created_at->format('Y-m-d');
    //     })
    //     ->addColumn('type', function (Admin $admin) {
    //         return view('Admin.admins.datatable.types', compact('admin'));
    //     })
    //     ->addColumn('status', function (Admin $admin) {
    //         return view('Admin.admins.datatable.status', compact('admin'));
    //     })
    //     ->addColumn('datatable', function (Admin $admin) {
    //         return view('Admin.admins.datatable.datatable',compact('admin'));
    //     })
    //     ->addColumn('roles_name', function (Admin $admin) {
    //         return view('Admin.admins.datatable.permissionLevel', compact('admin'));
    //     })
    //     ->rawColumns(['datatable'])
    //     ->toJson();
    // }
    public function create()
    {
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        return view('Admin.admins.create',compact('models','permissionMaps'));
    }
    public function store(SupervisorRequest $request)
    {
        try{
            $input = $request->except(['password','password_confirmation','permissions']);
            $input['email_verified_at'] = now();
            $input['password'] = bcrypt($request->password);
            $admin=Admin::create($input);
            $admin->syncPermissions($request->permissions);
            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect()->route('admin.admins.index');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function edit(Admin $admin)
    {
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        return view('Admin.admins.edit',compact('admin','models','permissionMaps'));
    }
    public function update(SupervisorRequest $request, Admin $admin)
    {
        $input = $request->except(['password','password_confirmation','permissions']);
        if(trim($request->password) != ''){
            $input['password'] = bcrypt($request->password);
        }
        $admin->update($input);
        $admin->syncPermissions($request->permissions);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->route('admin.admins.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }

    public function change_status($id)
    {
        $adminID = Crypt::decrypt($id);
        $admin = Admin::findorfail($adminID);
        ($admin->status == '1') ? $admin->status = 0 : $admin->status = 1;
        $admin->update();
        Alert::success(trans('admins.success'),trans('admins.change-succes'));
        return redirect()->back();
    }
}
