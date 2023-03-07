<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Backend\SubCategories\Store;
use App\Http\Requests\Backend\SubCategories\Update;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function index(){
        $cats = Category::all();
        return view('Admin.subcategories.index',compact('cats'));
    }

    public function data() {

        $subcategories = SubCategories::whenCatId(request()->cat_id)
        ->with(['category'])
        ->select();

        return DataTables::of($subcategories)->smart(true)
            ->addIndexColumn()
            ->editColumn('created_at', function (SubCategories $category) {
                return $category->created_at->format('Y-m-d');
            })
            ->editColumn('updated_at', function (SubCategories $category) {
                return $category->updated_at->format('Y-m-d');
            })
            ->editColumn('image',function (SubCategories $category){
                if($category->image == null){
                    $html = '<img width="100" src="'.asset('images/no-image.png').'">';
                }else{
                    $html = '<img width="100" src="'.asset('images/sub_categories/' . $category->image).'">';
                }
                return $html;
            })
            ->editColumn('category_id',function (SubCategories $category){
                return $category->category?->name;
            })
            ->addColumn('actions', function (SubCategories $category) {
                return view('Admin.subcategories.datatable.actions',compact('category'));
            })
            ->rawColumns(['actions','image'])
            ->toJson();
    }

    public function create(){

        $categories = Category::get(['id','name','translation']);

        return view('Admin.subcategories.create',compact('categories'));
    }

    public function store(Store $request){
        try{
            // toast('added success','success');
            $category = new SubCategories();
            if($request->image){
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/sub_categories/'), $filename);
                $category->image = $filename;
            }
            if(!empty($request->translations))
            {
                $category->translation = $request->translations;
            }else{
                $category->translation=[];
            }
            $category->name = Str::slug($request->name);
            $category->category_id = $request->category_id;
            $category->admin_add = Auth::user()->name;
            $category->save();
            $pro = SubCategories::where('id',$category->id)->update([
                'namear' => $category->translation['name']['ar']??null,
                'nameen' => $category->translation['name']['en']??null,
                'nametr' => $category->translation['name']['tr']??null,
                'descar' => $category->translation['description']['ar']??null,
                'descen' => $category->translation['description']['en']??null,
                'desctr' => $category->translation['description']['tr']??null,
                'catar'  => $category->category->translation['name']['ar']??null,
                'caten'  => $category->category->translation['name']['en']??null,
                'cattr'  => $category->category->translation['name']['tr']??null,
             ]);
             Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect(route('admin.subcategories.index'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id){
        try{

            $categories = Category::get(['id','name','translation']);

            $subcategory = SubCategories::where('id',$id)->first();
            return view('Admin.subcategories.edit',compact('subcategory','categories'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function update(Update $request){
        try{
            // toast('updated success','success');
            $category = SubCategories::where('id',$request->id)->first();
            if($request->image){
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/sub_categories/'), $filename);
                $category->image = $filename;
            }
            if(!empty($request->translations))
            {
                $category->translation = $request->translations;
            }else{
                $category->translation=[];
            }
            $category->name = $request->name;
            $category->category_id = $request->category_id;
            $category->admin_edit = Auth::user()->name;
            $category->namear = $category->translation['name']['ar']??null;
            $category->nameen = $category->translation['name']['en']??null;
            $category->nametr = $category->translation['name']['tr']??null;
            $category->descar = $category->translation['description']['ar']??null;
            $category->descen = $category->translation['description']['en']??null;
            $category->desctr = $category->translation['description']['tr']??null;
            $category->catar  = $category->category->translation['name']['ar']??null;
            $category->caten  = $category->category->translation['name']['en']??null;
            $category->cattr  = $category->category->translation['name']['tr']??null;

            $category->save();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            return redirect(route('admin.subcategories.index'));
            // return back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        try{
            // toast('deleted success','success');
            $category = SubCategories::where('id',$request->id)->delete();
            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
