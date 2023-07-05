<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Categories\Store;
use App\Http\Requests\Backend\Categories\Update;
use App\Models\Category;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Psy\Util\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    public function index(){
        return view('Admin.categories.index');
    }

    public function data() {
        $categories = Category::select();
        return DataTables::of($categories)->smart(true)
            ->addIndexColumn()
            ->editColumn('created_at', function (Category $category) {
                return $category->created_at->format('Y-m-d');
            })
            ->editColumn('updated_at', function (Category $category) {
                return $category->updated_at->format('Y-m-d');
            })
            ->editColumn('image',function (Category $category){
                if($category->image == null){
                    $html = '<img width="100" src="'.asset('images/no-image.png').'">';
                }else{
                    $html = '<img width="100" src="'.asset('images/categories/' . $category->image).'">';
                }
                return $html;
            })
            ->addColumn('actions', function (Category $category) {
                return view('Admin.categories.datatable.actions',compact('category'));
            })
             ->rawColumns(['image','actions'])
            ->toJson();
    }

    public function create(){
        return view('Admin.categories.create');
    }

    public function store(Store $request){

        try{
            $request->validated();
            // toast('added success','success');
            $category = new Category();
            if ($request->cropImages && count($request->cropImages) > 0) {

                foreach ($request->cropImages as $image) {
                    $imageData = decodeBase64Image($image);
                    $file_name =time()  . '.' . explode("/",$imageData["type"])[1];
                    $path = public_path('images/categories/' . $file_name);
                    $imagee = Image::make(base64_decode(explode(",",$image)[1]));
                    $imagee->save($path);
                    $category->image = $file_name;
                }
            }

            if(!empty($request->translations))
            {
                $category->translation = $request->translations;
            }else{
                $category->translation=[];
            }

            $category->name = \Illuminate\Support\Str::slug($request->name);
            $category->description = $request->description;
            $category->admin_add = Auth::user()->name;
            $category->save();
            $pro = Category::where('id',$category->id)->update([
                'namear' => $category->translation['name']['ar']??null,
                'nameen' => $category->translation['name']['en']??null,
                'nametr' => $category->translation['name']['tr']??null,
                'descar' => $category->translation['description']['ar']??null,
                'descen' => $category->translation['description']['en']??null,
                'desctr' => $category->translation['description']['tr']??null,
             ]);
             Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect(route('admin.categories.index'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }


    public function edit($id){
        try{
            $category = Category::where('id',$id)->first();
            return view('Admin.categories.edit',compact('category'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function update(Update $request){
        try{
            $request->validated();
            // toast('updated success','success');
            $category = Category::where('id',$request->id)->first();
//            if($request->image){
//                $filename = time().'.'.$request->image->extension();
//                $request->image->move(public_path('images/categories/'), $filename);
//                $category->image = $filename;
//            }
            if ($request->cropImages && count($request->cropImages) > 0) {
                foreach (getCroppedImages($request->cropImages) as $image) {
                    $imageData = decodeBase64Image($image);
                    @unlink(public_path('images/categories/' .$category->image ));
                    $file_name =time()  . '.' . explode("/",$imageData["type"])[1];
                    $path = public_path('images/categories/' . $file_name);
                    $imagee = Image::make(base64_decode(explode(",",$image)[1]));
                    $imagee->save($path);
                    $category->image = $file_name;
                }
            }
            if(!empty($request->translations))
            {
                $category->translation = $request->translations;
            }else{
                $category->translation=[];
            }
            $category->name = $request->name;
            $category->description = $request->description;
            $category->admin_edit = Auth::user()->name;
            $category->namear = $category->translation['name']['ar']??null;
            $category->nameen = $category->translation['name']['en']??null;
            $category->nametr = $category->translation['name']['tr']??null;
            $category->descar = $category->translation['description']['ar']??null;
            $category->descen = $category->translation['description']['en']??null;
            $category->desctr = $category->translation['description']['tr']??null;
            $category->save();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            return redirect(route('admin.categories.index'));
            // return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        try{
            // toast('deleted success','success');
            $category = Category::where('id',$request->id)->delete();
            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function getSubCategory($id){
        $categories = SubCategories::where('category_id',$id)->select('id','name','translation')->get();
        // $categories = SubCategories::where('category_id',$id)->get(['id','name','translation','namear']);
        // $categories = SubCategories::where('category_id',$id)->pluck(['id','translation']);
        // $categories = SubCategories::where('category_id',$id)->get(['id','name','translation["name"][app()->getLocale()]']);
        return json_encode($categories);
    }
}
