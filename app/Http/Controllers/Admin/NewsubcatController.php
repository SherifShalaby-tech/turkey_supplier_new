<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Categories\Store;
use App\Http\Requests\Backend\Categories\Update;
use App\Models\Category;
use App\Models\Color;
use App\Models\Company;
use App\Models\Leadtime;
use App\Models\NewCategory;
use App\Models\NewSubCategory;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Size;
use App\Models\SubCategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;


class NewsubcatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_newcat')->only(['index']);
        $this->middleware('permission:create_newcat')->only(['create', 'store']);
        $this->middleware('permission:update_newcat')->only(['edit', 'update']);
        $this->middleware('permission:delete_newcat')->only(['delete']);

    }// end of __construct
    public function index()
    {
        try {
            return view('Admin.newsubcats.index');
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());

            return redirect()->back();
        }
    }


    public function data()
    {
        $newsubcats = NewSubCategory::select();
        return DataTables::of($newsubcats)->smart(true)
            ->addIndexColumn()
            ->editColumn('created_at', function (Newsubcategory $newsubcat) {
                return $newsubcat->created_at->format('Y-m-d');
            })
            ->addColumn('status', function (Newsubcategory $newsubcat) {
                return view('Admin.newsubcats.datatable.status', compact('newsubcat'));
            })
            ->addColumn('actions', function (Newsubcategory $newsubcat) {
                return view('Admin.newsubcats.datatable.actions', compact('newsubcat'));
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function destroy(Request $request)
    {
        try {
            $newsubcat = Newsubcategory::where('id', $request->id)->first();
            $newsubcat->delete();
            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());

            return redirect()->back();
        }
    }




}
