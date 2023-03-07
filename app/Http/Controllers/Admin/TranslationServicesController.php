<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Http\Requests\TranslationServicesRequest;
use App\Http\Requests\UserRequest;
use App\Models\TranslationServices;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
class TranslationServicesController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:read_translationServices')->only(['index']);
    //     $this->middleware('permission:create_translationServices')->only(['create', 'store']);
    //     $this->middleware('permission:update_translationServices')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_translationServices')->only(['delete']);

    // }// end of __construct
    public function index(){
        return view('Admin.translationServices.index');
    }
    public function data() {
        $translationServices = TranslationServices::select();
        return DataTables::of($translationServices)
        ->addIndexColumn()
        ->editColumn('created_at', function (TranslationServices $translationServices) {
            return $translationServices->created_at->format('Y-m-d');
        })
        ->addColumn('tocompanyname', function (TranslationServices $translationServices) {
            return $translationServices->company->name ?? null;
        })
        ->addColumn('tocompanyphone', function (TranslationServices $translationServices) {
            return $translationServices->company->phone ?? null;
        })
        ->addColumn('tocompanyemail', function (TranslationServices $translationServices) {
            return $translationServices->company->email ?? null;
        })
        ->addColumn('languages', function(TranslationServices $translationServices) {
            return view('Admin.translationServices.data_table.languages', compact('translationServices'));
        })
        ->addColumn('image', function (TranslationServices $translationServices) {
            return view('Admin.translationServices.data_table.image', compact('translationServices'));
        })
        ->addColumn('actions', function (TranslationServices $translationServices) {
            return view('Admin.translationServices.data_table.actions',compact('translationServices'));
        })
        ->rawColumns(['actions'])
        ->toJson();
    }
    public function create()
    {
        return view('Admin.translationServices.create');
    }
    public function store(TranslationServicesRequest $request)
    {
        try{
            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            $request->validated();
            $translation_ser = new TranslationServices();
            if(!empty($request->translations))
            {
                $translation_ser->translation = $request->translations;
            }else{
                $translation_ser->translation=[];
            }
            $translation_ser->name = $request->name;
            $translation_ser->companyname = $request->companyname;
            $translation_ser->phone = $request->phone;
            $translation_ser->country = $request->country;
            $translation_ser->language = $request->language;
            $translation_ser->company_id = $request->company_id;
            $translation_ser->notes = $request->notes;
            $translation_ser->save();
            return redirect()->route('admin.translationServices.index');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    // public function edit(TranslationServices $translationServices)
    public function edit($id)
    {
        $translationServices = TranslationServices::find($id);
        // dd($id);
        return view('Admin.translationServices.edit',compact('translationServices'));
    }
    public function update(TranslationServicesRequest $request, $id)
    {
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        $request->validated();
        $translationServices = TranslationServices::find($id);
        if(!empty($request->translations))
        {
            $translationServices->translation = $request->translations;
        }else{
            $translationServices->translation=[];
        }
        $translationServices->name = $request->name;
        $translationServices->companyname = $request->companyname;
        $translationServices->phone = $request->phone;
        $translationServices->country = $request->country;
        $translationServices->language = $request->language;
        $translationServices->company_id = $request->company_id;
        $translationServices->notes = $request->notes;
        $translationServices->save();
        return redirect()->route('admin.translationServices.index');
    }

    public function destroy($id)
    {
        $translationServices = TranslationServices::find($id);
        if($translationServices->image != null && file_exists(public_path('/images/translationservice/' . $translationServices->image))){
            unlink('images/translationservice/' . $translationServices->image);
        }
        $translationServices->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
