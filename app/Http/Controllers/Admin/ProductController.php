<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Categories\Store;
use App\Http\Requests\Backend\Categories\Update;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Color;
use App\Models\Company;
use App\Models\Leadtime;
use App\Models\Media;
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


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_product')->only(['index']);
        $this->middleware('permission:create_product')->only(['create', 'store']);
        $this->middleware('permission:update_product')->only(['edit', 'update']);
        $this->middleware('permission:delete_product')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $cats = Category::all();
        $subcats = SubCategories::all();
        $coms = Company::with('products')->where('trade_role','seller')->get();
        return view('Admin.products.index',compact('cats','subcats','coms'));
    }


    public function data()
    {
        if (auth('admin')->user()) {
            $products = Product::whenCatId(request()->cat_id)
            ->whenComId(request()->com_id)
            ->whenSubcatId(request()->subcat_id)
            ->with(['category','subcategory','company'])
            ->select();
        }
        if (auth('company')->user()) {
            $products = Product::whenCatId(request()->cat_id)
            ->whenSubcatId(request()->subcat_id)
            ->whenComId(request()->com_id)
            ->with(['category','subcategory','company'])
            ->where('company_id', Auth::guard('company')->user()->id)->select();
        }
        if (auth('clerk')->user()) {
            $products = Product::whenCatId(request()->cat_id)
            ->whenSubcatId(request()->subcat_id)
            ->whenComId(request()->com_id)
            ->with(['category','subcategory','company'])
            ->where('company_id', Auth::guard('clerk')->user()->company->id)->select();
        }
        return DataTables::of($products)->smart(true)
            ->addIndexColumn()
            ->editColumn('created_at', function (Product $product) {
                return $product->created_at->format('Y-m-d');
            })
            ->addColumn('company', function (Product $product) {
                return $product->company?->name;
            })
            ->addColumn('productimagecount', function (Product $product) {
                return $product->media?->count();
            })

            ->editColumn('description', function (Product $product) {
                return view('Admin.products.datatable.description', compact('product'));
            })
            ->addColumn('categoryandsub', function (Product $product) {
                return ucfirst($product->category?->name) .'/' . strtolower($product->subcategory?->name);
            })
            ->editColumn('category_id', function (Product $product) {
                return $product->category?->name ;
            })
            ->editColumn('subcategory_id', function (Product $product) {
                return $product->subcategory?->name;
            })
            ->editColumn('updated_at', function (Product $product) {
                return $product->updated_at->format('Y-m-d');
            })
            ->editColumn('name', function (Product $product) {
                return $product->name ?? null;
            })
            ->addColumn('actions', function (Product $product) {
                return view('Admin.products.datatable.actions', compact('product'));
            })
            ->rawColumns(['image', 'actions', 'category_id'])
            ->toJson();
    }

    public function create()
    {
        $categories = Category::get(['id', 'name', 'translation']);
        $subcategories = SubCategories::get(['id', 'name', 'translation']);
        $companies = Company::get(['id', 'name', 'translation']);
        return view('Admin.products.create', compact('categories', 'companies', 'subcategories'));
    }

    public function store(\App\Http\Requests\Backend\Products\Store $request)
    {
        DB::beginTransaction();
        try {
            // $request->validated();
        // auth company condition product count
            if (auth('company')->user()){
                if (Product::where('company_id',auth('company')->user()->id)->count() > auth('company')->user()->plan->product_count){
                    Alert::error('error message',trans('custom.plan_validation_1'));
                    return redirect()->back();
                }
            }else{
                $company_id = Company::where('id',$request->company_id)->first();
                if (Product::where('company_id',$request->company_id)->count() > $company_id->plan->product_count){
                    Alert::error('error message',trans('custom.plan_validation_1'));
                    return redirect()->back();
                }
            }
            $product = new Product();
            // auth company condition character count
            if(auth('company')->user()){
                if (strlen($request->description) > auth('company')->user()->plan->character_count){
                    Alert::error('error msg',trans('custom.plan_validation_2'));
                    return redirect()->back();
                }
            }else{
                $company_id = Company::where('id',$request->company_id)->first();
                if (strlen($request->description) > $company_id->plan->character_count){
                    Alert::error('error message',trans('custom.plan_validation_1'));
                    return redirect()->back();
                }
            }
            if (!empty($request->translations)) {
                $product->translation = $request->translations;
            } else {
                $product->translation = [];
            }
            $product->code = mt_rand(1000000000, 9999999999); // better than rand()
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->company_id = $request->company_id;
            $product->weight = $request->weight;
            $product->description = $request->description;
            $product->video_description = $request->video_description;
            $product->Packaging = $request->Packaging;
            $product->Supply_Ability = $request->Supply_Ability;
            $product->Place_Origin = $request->Place_Origin;
            $product->admin_add = Auth::user()->name;
            $product->save();

            $pro = Product::where('id',$product->id)->update([
               'slug' => Str::slug($product->name) . $product->id,
               'namear' => $product->translation['name']['ar']??null,
               'nameen' => $product->translation['name']['en']??null,
               'nametr' => $product->translation['name']['tr']??null,
               'descar' => $product->translation['description']['ar']??null,
               'descen' => $product->translation['description']['en']??null,
               'desctr' => $product->translation['description']['tr']??null,
               'companyar' => $product->company->translation['name']['ar']??null,
               'companyen' => $product->company->translation['name']['en']??null,
               'companytr' => $product->company->translation['name']['tr']??null,
               'catar' => $product->category->translation['name']['ar']??null,
               'caten' => $product->category->translation['name']['en']??null,
               'cattr' => $product->category->translation['name']['tr']??null,
               'subcatar' => $product->subcategory->translation['name']['ar']??null,
               'subcaten' => $product->subcategory->translation['name']['en']??null,
               'subcattr' => $product->subcategory->translation['name']['tr']??null,
            ]);
            // loop product tags
            if ($request->tags) {
                $tags = ProductTag::create([
                    'tags' => $request->tags,
                    'product_id' => $product->id
                ]);
            }
            if ($request->images && count($request->images) > 0) {
                $i = 1;
                // auth company condition product count images
                if(auth('company')->user()){
                    if (count($request->images) > auth('company')->user()->plan->product_picture_count){
                        Alert::error('error msg',trans('custom.plan_validation_3'));
                        return redirect()->back();
                    }
                }else{
                    $company_id = Company::where('id',$request->company_id)->first();
                    if (count($request->images) > $company_id->plan->product_picture_count){
                        Alert::error('error message',trans('custom.plan_validation_1'));
                        return redirect()->back();
                    }
                }
                foreach ($request->images as $image) {
                    $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('images/products/' . $file_name);
                    Image::make($image->getRealPath())->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);
                    $product->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
            if ($request->certificates && count($request->certificates) > 0) {
                $i = 1;
                foreach ($request->certificates as $image) {
                    $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('images/products/certificates/' . $file_name);
                    Image::make($image->getRealPath())->resize(750, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);
                    $certificates= Certificate::create([
                        'image' => $file_name,
                        'product_id' => $product['id'],
                    ]);
                }
            }
            $class_lists = $request->class_list;
            foreach ($class_lists as $class_list) {
                $color = new Color();
                $color->colorName  = $class_list['colorName'] ?? null;
                $color->colorCode  = $class_list['colorCode'] ?? null;
                $color->product_id = $product->id;
                $color->save();

                $size = new Size();
                $size->sizeName  = $class_list['sizeName'];
                $size->product_id = $product->id;
                $size->save();

                $leadtime = new Leadtime();
                $leadtime->qty    = $class_list['leadtime_qty'];
                $leadtime->price  = $class_list['leadtime_price'];
                $leadtime->days   = $class_list['days'];
                $leadtime->product_id = $product->id;
                $leadtime->save();
            }
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect(route('admin.products.index'));
        } catch (\Exception $exception) {
            DB::rollback();
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
            //    return redirect()->back()->withErrors(['Error' => $exception->getMessage()]);
        }
    }

    public function showdata($id)
    {
        // dd($id);
        try {
            $product = Product::with('colors', 'sizes', 'leadtimes','category','subcategory','company','certificates')
            ->whereId($id)->first();
        //     $product = Product::with('colors', 'sizes', 'leadtimes')->where('id', $id)->first();
        //     $categories = Category::get(['id', 'name', 'translation']);
        //     $companies = Company::get(['id', 'name', 'translation']);
        //     $subcategories = SubCategories::get(['id', 'name', 'translation']);
            return view('Admin.products.show',compact('product'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        try {
            $product = Product::with('colors', 'sizes', 'leadtimes')->where('id', $id)->first();
            $categories = Category::get(['id', 'name', 'translation']);
            $companies = Company::get(['id', 'name', 'translation']);
            $subcategories = SubCategories::get(['id', 'name', 'translation']);
            return view('Admin.products.edit', compact('product', 'categories', 'companies', 'subcategories'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }


    public function update(\App\Http\Requests\Backend\Products\Update $request)
    {
        DB::beginTransaction();
        try {
            $request->validated();
            $product = Product::where('id', $request->id)->first();
            // auth company validation character count
            if(auth('company')->user()){
                if (strlen($request->description) > auth('company')->user()->plan->character_count){
                    Alert::error('error msg',trans('custom.plan_validation_2'));
                    return redirect()->back();
                }
            }

            // if($request->image){
            //     foreach ($request->image as $image){
            //         $filename = time().'.'.$image->extension();
            //         $image->move(public_path('images/products/'), $filename);
            //         $product->image = [$filename];
            //     }
            // }
            if (!empty($request->translations)) {
                $product->translation = $request->translations;
            } else {
                $product->translation = [];

            }
            // $product->code = $request->code;
            $product->name = $request->name;
            $product->price = $request->price;

            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->company_id = $request->company_id;
            $product->weight = $request->weight;
            $product->slug = Str::slug($product->name);
            $product->description = $request->description;
            $product->video_description = $request->video_description;
            $product->Packaging = $request->Packaging;
            $product->Supply_Ability = $request->Supply_Ability;
            $product->Place_Origin = $request->Place_Origin;
            $product->admin_edit = Auth::user()->name;

            $product->namear = $product->translation['name']['ar']??null;
            $product->nameen = $product->translation['name']['en']??null;
            $product->nametr = $product->translation['name']['tr']??null;
            $product->descar = $product->translation['description']['ar']??null;
            $product->descen = $product->translation['description']['en']??null;
            $product->desctr = $product->translation['description']['tr']??null;
            $product->companyar = $product->company->translation['name']['ar']??null;
            $product->companyen = $product->company->translation['name']['en']??null;
            $product->companytr = $product->company->translation['name']['tr']??null;
            $product->catar = $product->category->translation['name']['ar']??null;
            $product->caten = $product->category->translation['name']['en']??null;
            $product->cattr = $product->category->translation['name']['tr']??null;
            $product->subcatar = $product->subcategory->translation['name']['ar']??null;
            $product->subcaten = $product->subcategory->translation['name']['en']??null;
            $product->subcattr = $product->subcategory->translation['name']['tr']??null;
            $product->update();
            // loop product tags
            if ($request->tags) {
                $tags = ProductTag::where('product_id',$product->id)->update(['tags' => $request->tags]);
                if(!$tags){
                    $tags = ProductTag::create([
                        'tags' => $request->tags,
                        'product_id' => $product->id
                    ]);
                }
            }
            if ($request->images && count($request->images) > 0) {
                $i = $product->media()->count() + 1;
                // auth company validation product image count
                if(auth('company')->user()){
                    if (count($request->images) > auth('company')->user()->plan->product_picture_count){
                        Alert::error('error msg',trans('custom.plan_validation_3'));
                        return redirect()->back();
                    }
                    if (Media::where('mediable_id',$product->id)->count() > auth('company')->user()->plan->product_picture_count){
                        Alert::error('error msg','عدد الصور كبير جدا عن المتاح فى الباقة');
                        return redirect()->back();
                    }
                }
                foreach ($request->images as $image) {
                    $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('images/products/' . $file_name);
                    Image::make($image->getRealPath())->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);
                    $product->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
            // $class_lists = $request->class_list;
            // $colors    = Color::where('product_id',$product->id)->get();
            // $sizes     = Size::where('product_id',$product->id)->get();
            // $leadtimes = Leadtime::where('product_id',$product->id)->get();
            // foreach($class_lists as $class_list){
            //      foreach($colors as $color){
            //              $color->colorName = $class_list['colorName'];
            //              $color->update();
            //      }
            //      foreach($sizes as $size){
            //              $size->sizeName = $class_list['sizeName'];
            //              $size->update();
            //      }
            //      foreach($leadtimes as $leadtime){
            //              $leadtime->qty = $class_list['leadtime_qty'];
            //              $leadtime->price = $class_list['leadtime_price'];
            //              $leadtime->days = $class_list['days'];
            //              $leadtime->update();
            //      }
            // }
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            return redirect(route('admin.products.index'));
            // return redirect()->back();

        } catch (\Exception $exception) {
            DB::rollback();
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        try {
            $product = Product::where('id', $request->id)->first();
            if ($product->media()->count() > 0) {
                foreach ($product->media as $media) {
                    if (File::exists(public_path('images/products/' . $media->file_name))) {

                        unlink('images/products/' . $media->file_name);
                    }
                    $media->delete();
                }
            }
            $product->delete();

            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());

            return redirect()->back();
        }
    }


    public function remove_image(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $image = $product->media()->whereId($request->image_id)->first();

        if (File::exists('images/products/' . $image->file_name)) {
            unlink('images/products/' . $image->file_name);

        }
        $image->delete();
        return true;
    }
    public function addcat (Request $request){
        $this->validate($request, [
            'categoryname' => 'required',
            ]);
            $input['categoryname'] = $request->categoryname;
            $input['username'] = Auth::user()->name;
            $input['useremail'] = Auth::user()->email;
            $input['userphone'] = Auth::user()->phone;
            $input['status'] = 0;
            NewCategory::create($input);
            Alert::success(trans('admins.success'), trans('admins.adminsms'));
            return redirect()->back();

    }
    public function addsubcat (Request $request){
        $this->validate($request, [
            'categoryname' => 'required',
            'subcategoryname' => 'required',
            ]);
            $input['subcategoryname'] = $request->subcategoryname;
            $input['categoryname'] = $request->categoryname;
            $input['username'] = Auth::user()->name;
            $input['useremail'] = Auth::user()->email;
            $input['userphone'] = Auth::user()->phone;
            $input['status'] = 0;
            NewSubCategory::create($input);
            Alert::success(trans('admins.success'), trans('admins.adminsms'));
            return redirect()->back();

    }

    public function upload_image(Request $request)
    {
        dd($request->company_id);
        // $company = Company::findOrFail($request->company_id);
        // $image = $company->media()->whereId($request->image_id)->first();
        // if (File::exists('images/company/' . $image->file_name)) {
        //     unlink('images/company/' . $image->file_name);
        // }
        // $image->delete();
        // return true;
    }
}
