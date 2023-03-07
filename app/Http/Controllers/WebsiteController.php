<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\TranslationServicesRequest;
use App\Http\Requests\Website\addRating;
use App\Http\Requests\Website\contact_supplier;
use App\Http\Requests\Website\MediationRequest\Store;
use App\Http\Requests\Website\shipmentOrder\add_order;
use App\Http\Requests\Website\Subscribe;
use App\Http\Requests\Website\visitor_contact_supplier;
use App\Mail\WelcomeMail;
use App\Models\Aboutnew;
use App\Models\AboutUs;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\ContactSupplier;
use App\Models\Favorite;
use App\Models\HelpCenter;
use App\Models\MediationOrder;
use App\Models\Mediation;
use App\Models\Message;
use App\Models\Plan;
use App\Models\PolicieRule;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SearchProduct;
use App\Models\Service;
use App\Models\Setting;
use App\Models\ShipmentServices;
use App\Models\SubCategories;
use App\Models\SupportChat;
use App\Models\TradeShow;
use App\Models\Translation;
use App\Models\TranslationServices;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        if(app()->getLocale() == 'ar'){
            $cats = Category::orderBy('namear')->get(['id', 'name', 'translation']);
        }elseif(app()->getLocale() == 'en'){
            $cats = Category::orderBy('nameen')->get(['id', 'name', 'translation']);
        }elseif(app()->getLocale() == 'tr'){
            $cats = Category::orderBy('nametr')->get(['id', 'name', 'translation']);
        }else{
            $cats = Category::orderBy('name')->get(['id', 'name', 'translation']);
        }
        $categories = Category::orderBy('translation->name')->get(['id', 'name', 'translation']);
        $trending_product = Product::where('trending','!=',0)
            ->take(20)
            ->orderBy('trending','DESC')
            ->latest()
            ->get(['id', 'name', 'price', 'category_id', 'slug', 'translation','trending']);
        if (auth('company')->user()){
            $products = SearchProduct::where('buyer_id',auth('company')->user()->id)
                ->with(['product' => function($q){
                    $q->orderBy('views','DESC');
                }])
                ->take(20)
                ->get(['id','product_id','buyer_id']);
        }else{
            $products = $trending_product;
        }
        $top_rated_products = Product::select('products.*')
            ->Join('ratings', 'products.id', 'ratings.product_id')
            ->orderBy('ratings.rating', 'DESC')
            ->distinct('products.id')
            ->take(8)
            ->get(['id', 'name', 'price', 'category_id', 'slug', 'translation']);
        $best_sellers = Company::query()->where('trade_role', 'seller')
            ->select('id', 'name', 'phone', 'translation')
            ->take(20)
            ->get();
        $latest_trade = Mediation::select(['id', 'title', 'image'])->latest()->first();
        $ads = Ad::get(['id', 'image', 'title']);
        $services = Service::get(['id', 'name', 'description']);
        $mediation = Mediation::first();
        $translation = Translation::first();
        return view('website.index', compact('cats','ads', 'products', 'trending_product','translation', 'top_rated_products', 'best_sellers', 'latest_trade', 'services', 'mediation'));
    }

    public function buyerProfile($id)
    {
        try {
            $buyer = Company::where('id', $id)->first();
            return view('website.buyer.profile', compact('buyer'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getProductsYouMayLike()
    {
        try {
            $products = Product::where('views','!=',0)
                ->latest()
                ->orderBy('views', 'DESC')
                ->select(['id', 'name', 'price', 'category_id', 'slug', 'translation'])
                ->paginate(12);
            return view('website.products.you_may_like', compact('products'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getTrendingProducts()
    {
        try {
            $products = Product::where('trending','!=',0)
                ->orderBy('trending', 'DESC')
                ->latest()
                ->select(['id', 'name', 'price', 'category_id', 'slug', 'translation'])
                ->paginate(12);
            return view('website.products.trending_products', compact('products'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getSellers(Request $request)
    {
        try {
            $sellers = Company::with('products')
                ->select('id', 'name', 'phone','namear','nameen','nametr')
                ->with('products');
            $products = Product::select('id', 'name','company_id','namear','nameen','nametr','companyar','companyen','companytr')
                ->with(['company']);
            $category = Category::select('id','name','image','translation','namear','nameen','nametr')
                ->with(['products']);
            if($request->name){
                $category = $category->where("name",$request->name)
                ->orwhere("namear",$request->name)
                ->orwhere("nameen",$request->name)
                ->orwhere("nametr",$request->name);
                $products = $products->where("name",$request->name)
                ->orwhere("namear",$request->name)
                ->orwhere("nameen",$request->name)
                ->orwhere("nametr",$request->name)
                ->orwhere("companyar",$request->name)
                ->orwhere("companyen",$request->name)
                ->orwhere("companytr",$request->name);
                $sellers = $sellers->where("name",'like','%' .$request->name. '%')
                ->orWhere("namear",'like','%' .$request->name. '%')
                ->orWhere("nameen",'like','%' .$request->name. '%')
                ->orWhere("nametr",'like','%' .$request->name. '%');
            }
            $category = $category->first();
            $sellers = $sellers->get();
            $products = $products->paginate(12);
            if($category){
                foreach ($category->products as $pro){
                    $company = Company::where('id',$pro->company_id)->distinct()->get(['id','name','translation','phone']);
                }
                $company_distinct = $company;
                return view('website.supplier.index', compact('sellers', 'products', 'category','company_distinct'));
            }elseif($sellers->count() > 0 || $products->count() > 0){
                return view('website.supplier.index', compact('sellers', 'products', 'category'));
            }else{
                Alert::error('error msg',trans('custom.categories_not_found'));
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
        }
    }

    public function getNewArrivals()
    {
        $categories = Category::has('products')->get(['id', 'name']);
        $new_arrivals = Product::orderBy('created_at', 'desc')->take(8)->latest()->get(['id', 'name', 'price', 'category_id']);
        return view('website.new_arrivals', compact('categories', 'new_arrivals'));
    }

    public function getProductDetails($details)
    {
        $product = Product::where("slug", $details)->first();
        $product->views = $product->views + 1;
        $product->save();
        if(auth('company')->user()){
            if(!SearchProduct::where('buyer_id',auth('company')->user()->id)
                ->where('product_id',$product->id)
                ->exists()){
                $productSearch = SearchProduct::create([
                    'product_id' => $product->id,
                    'buyer_id' => auth('company')->user()->id,
                ]);
            }
        }
        $related_product = Product::where('sub_category_id',$product->sub_category_id)
            ->whereNotIn('id', [$product->id])
            ->paginate(8);
        $Other_products = Product::where('company_id', $product->company_id)->whereNotIn('id', [$product->id])->get(['id', 'name', 'price', 'category_id', 'description', 'company_id', 'translation', 'slug']);
        return view('website.products.details', compact('product', 'related_product', 'Other_products'));
    }


    public function searchProduct(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data_categories = Category::orwhere('namear', 'like', '%' . $request->name . '%')
                    ->orwhere('namear',$request->name)
                    ->orwhere('nameen', 'like', '%' . $request->name . '%')
                    ->orwhere('nameen',$request->name)
                    ->orwhere('nametr', 'like', '%' . $request->name . '%')
                    ->orwhere('nametr',$request->name)
                    ->orwhere('descen', 'like', '%' . $request->name . '%')
                    ->orwhere('descen',$request->name)
                    ->orwhere('descar', 'like', '%' . $request->name . '%')
                    ->orwhere('descar',$request->name)
                    ->orwhere('desctr', 'like', '%' . $request->name . '%')
                    ->orwhere('desctr',$request->name)
//                    ->orderBy('id','desc')
                    ->get(['name']);
                $data2 = Company::orwhere('namear', 'like', '%' . $request->name . '%')
                    ->orwhere('namear',$request->name)
                    ->orwhere('nameen', 'like', '%' . $request->name . '%')
                    ->orwhere('nameen',$request->name)
                    ->orwhere('nametr', 'like', '%' . $request->name . '%')
                    ->orwhere('nametr',$request->name)
                    ->orwhere('descen', 'like', '%' . $request->name . '%')
                    ->orwhere('descen',$request->name)
                    ->orwhere('descar', 'like', '%' . $request->name . '%')
                    ->orwhere('descar',$request->name)
                    ->orwhere('desctr', 'like', '%' . $request->name . '%')
                    ->orwhere('desctr',$request->name)
//                    ->orderBy('id','desc')
                    ->get(['name']);
                $data_products = Product::orwhere('namear', 'like', '%' . $request->name . '%')
                        ->orwhere('namear',$request->name)
                        ->orwhere('nameen', 'like', '%' . $request->name . '%')
                        ->orwhere('nameen',$request->name)
                        ->orwhere('nametr', 'like', '%' . $request->name . '%')
                        ->orwhere('nametr',$request->name)
                        ->orwhere('descen', 'like', '%' . $request->name . '%')
                        ->orwhere('descen',$request->name)
                        ->orwhere('descar', 'like', '%' . $request->name . '%')
                        ->orwhere('descar',$request->name)
                        ->orwhere('desctr', 'like', '%' . $request->name . '%')
                        ->orwhere('desctr',$request->name)
                        ->orwhere('companyar', 'like', '%' . $request->name . '%')
                        ->orwhere('companyar',$request->name)
                        ->orwhere('companyen', 'like', '%' . $request->name . '%')
                        ->orwhere('companyen',$request->name)
                        ->orwhere('companytr', 'like', '%' . $request->name . '%')
                        ->orwhere('companytr',$request->name)
                        ->orwhere('catar', 'like', '%' . $request->name . '%')
                        ->orwhere('catar',$request->name)
                        ->orwhere('caten', 'like', '%' . $request->name . '%')
                        ->orwhere('caten',$request->name)
                        ->orwhere('cattr', 'like', '%' . $request->name . '%')
                        ->orwhere('cattr',$request->name)
                        ->orwhere('subcatar', 'like', '%' . $request->name . '%')
                        ->orwhere('subcatar',$request->name)
                        ->orwhere('subcaten', 'like', '%' . $request->name . '%')
                        ->orwhere('subcaten',$request->name)
                        ->orwhere('subcattr', 'like', '%' . $request->name . '%')
                        ->orwhere('subcattr',$request->name)
//                      ->orderBy('id','desc')
                        ->get(['name']);
                $output = "";
                if (count($data_categories) > 0) {
                    $output .= "<ul class='list-group' style='display: block;position: relative;z-index: 1'>";
                    foreach ($data_categories as $row) {
                        $output .= "<li class='list-group-item'><a onclick='document.getElementById(`form`).submit();' class='link-search-sp' href='#'>" . $row->name . "</a></li>";
                    }
                    $output .= "</ul>";
                } elseif (count($data2) > 0) {
                    $output .= "<ul class='list-group' style='display: block;position: relative;z-index: 1'>";
                    foreach ($data2 as $row) {
                        $output .= "<li class='list-group-item'><a onclick='document.getElementById(`form`).submit();' class='link-search-sp' href='#'>" . $row->name . "</a></li>";
                    }
                    $output .= "</ul>";
                } elseif ($data_products->count() > 0) {
                    $output .= "<ul class='list-group' style='display: block;position: relative;z-index: 1'>";
                    foreach ($data_products as $row) {
                        $output .= "<li class='list-group-item'><a onclick='document.getElementById(`form`).submit();' class='link-search-sp' href='#'>" . $row->name . "</a></li>";
                    }
                    $output .= "</ul>";
                } else {
                    $output .= "<li class='list-group-item'>No Data</li>";
                }
                return $output;
            }
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function about_us()
    {
        // $data = AboutUs::select('about_us','services','shipping_products','mediation')->first();
        $abouts = Aboutnew::whereStatus(1)->get();
        return view('website.about', compact('abouts'));
    }

    public function shipping()
    {
        $shipping_services = ShipmentServices::get([
            'id', 'name', 'detail', 'image', 'user_id', 'basic_shipping_service','translation'
        ]);
        return view('website.shipping.index', compact('shipping_services'));
    }

    public function shippingDetails($id)
    {
        $shipping = ShipmentServices::where('id', $id)->first();
        return view('website.shipping.details', compact('shipping'));
    }

//     public function shipment_order(add_order $request)
//     {
// //        dd('hellooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo');
//         try {
//             $request->validated();
//             Alert::success('success msg', 'Shipment order success');
//             $shipment_order = DB::table('shipment_orders')->insert([
//                 'long_m' => $request->long_m,
//                 'long_c' => $request->long_c,
//                 'high_m' => $request->high_m,
//                 'high_c' => $request->high_c,
//                 'wide_m' => $request->wide_m,
//                 'wide_c' => $request->wide_c,
//                 'email' => $request->email,
//                 'full_name' => $request->full_name,
//                 'shipment_type' => $request->shipment_type,
//                 'shipment_services_id' => $request->shipment_services_id,
//                 'user_id' => $request->user_id
//                 //11   in database 12 in form
//             ]);
//             return redirect()->back();
//         } catch (\Exception $exception) {
//             Alert::error('error msg', $exception->getMessage());
//             return redirect()->back();
//         }
//     }

    public function publicSearch(Request $request)
    {
        try {
            $products = Product::where('name','like','%' .$request->name. '%')
                ->orWhere('namear','like','%' .$request->name. '%')
                ->orWhere('nameen','like','%' .$request->name. '%')
                ->orWhere('nametr','like','%' .$request->name. '%')
//                ->orWhere('descen','like','%' .$request->name. '%')
//                ->orWhere('descar','like','%' .$request->name. '%')
//                ->orWhere('desctr','like','%' .$request->name. '%')
                ->orWhere('companyar','like','%' .$request->name. '%')
                ->orWhere('companyen','like','%' .$request->name. '%')
                ->orWhere('companytr','like','%' .$request->name. '%')
                ->orWhere('catar','like','%' .$request->name. '%')
                ->orWhere('caten','like','%' .$request->name. '%')
                ->orWhere('cattr','like','%' .$request->name. '%')
                ->orWhere('subcatar','like','%' .$request->name. '%')
                ->orWhere('subcaten','like','%' .$request->name. '%')
                ->orWhere('subcattr','like','%' .$request->name. '%')
//                ->orderBy('id','desc')
                ->get();
            foreach ($products as $product){
                $pro = Product::where('id',$product->id)->first();
                $pro->trending = $pro->trending +1;
                $pro->save();
            }
            $categories = Category::where('name','like','%' .$request->name. '%')
                ->orWhere('namear','like','%' .$request->name. '%')
                ->orWhere('nameen','like','%' .$request->name. '%')
                ->orWhere('nametr','like','%' .$request->name. '%')
//                ->orWhere('descen','like','%' .$request->name. '%')
//                ->orWhere('descar','like','%' .$request->name. '%')
//                ->orWhere('desctr','like','%' .$request->name. '%')
//                ->orderBy('id','desc')
                ->get();
            $companies = Company::where('name','like','%' .$request->name. '%')
                ->orWhere('namear','like','%' .$request->name. '%')
                ->orWhere('nameen','like','%' .$request->name. '%')
                ->orWhere('nametr','like','%' .$request->name. '%')
//                ->orWhere('descen','like','%' .$request->name. '%')
//                ->orWhere('descar','like','%' .$request->name. '%')
//                ->orWhere('desctr','like','%' .$request->name. '%')
//                ->orderBy("id",'desc')
                ->get();

            return view('website.products.result_search', compact('products', 'categories', 'companies'));
            //return response()->json($companies,$categories,$products);
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function contactSupplier(contact_supplier $request)
    {
        // dd($buyer->name);
        // dd($request->all());
        try {
            $request->validated();
            if ($request->supplier_id == $request->user_id) {
                Alert::error('error msg', 'Error');
                return redirect()->back();
            } else {
                $buyer = Company::whereId($request->user_id)->first();
                $product = Product::whereId($request->product_id)->first();
                $contact_supplier = new ContactSupplier();
                if ($request->file('file')) {
                    // $filename = time().'.'.$request->file->extension();
                    // $request->file->move(public_path('Attachments/'), $filename);
                    $filename = md5($request->file . microtime()) . '.' . $request->file->extension();
                    $request->file->move(public_path('Attachments/'), $filename);
                    // $request->file->storeAs('/','Attachments/', $filename, 'media');
                    $contact_supplier->file = $filename;
                    // $contact_supplier->ex = '.' . $request->file->extension();
                }
                $contact_supplier->supplier_id = $request->supplier_id;        // الشركه البائع
                $contact_supplier->product_id = $request->product_id;
                $contact_supplier->user_id = Auth::guard('company')->user()->id;   // المشترى
                $contact_supplier->name = Auth::guard('company')->user()->name;
                $contact_supplier->email = Auth::guard('company')->user()->email;
                $contact_supplier->address = $request->address;
                $contact_supplier->message = $request->message;
                $contact_supplier->subject = $request->subject;
                // $contact_supplier->topic       = $request->topic;
                $contact_supplier->save();
            }
            //            $company = Company::whereId($contact_supplier->supplier_id)->first();
            //            Mail::to($company->email)->send(new WelcomeMail());

            Alert::success(trans('contactSuppliers.success'), trans('contactSuppliers.smsendseller'));
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function downloadFiles($fileName){
        try{
            $path = public_path('Attachments/' . $fileName);
            return \Illuminate\Support\Facades\Response::download($path);
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function productRating(addRating $request)
    {
        try {
            $request->validated();
            $rating = DB::table('ratings')->insert([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
            ]);
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function subscribe(Subscribe $request)
    {
        try {
            Alert::success('success', 'Subscription Done');
            $request->validated();
            if (\App\Models\SubScribe::where('email', $request->email)->exists()) {
                Alert::error('error msg', 'You are already with us');
                return redirect()->back();
            }
            $subscribe = DB::table('sub_scribes')->insert([
                'email' => $request->email
            ]);
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getAllCategories(Request $request)
    {
        try{
            $categories_data = Category::select('id', 'name', 'image','translation','namear','nameen','nametr')->with(['products']);
            $products = Product::select('id', 'name', 'category_id','namear','nameen','nametr','companyar','companyen','companytr')->with(['category']);
            $company = Company::with('products')->select('id', 'name', 'phone','namear','nameen','nametr');
            if ($request->name) {
                $categories_data = $categories_data->where("name","like","%" .$request->name. "%")
                    ->orWhere("namear","like","%" .$request->name. "%")
                    ->orWhere("nameen","like","%" .$request->name. "%")
                    ->orWhere("nametr","like","%" .$request->name. "%");
                $products = $products->where("name",$request->name)
                    ->orWhere("namear",$request->name)
                    ->orWhere("nameen",$request->name)
                    ->orWhere("nametr",$request->name)
                    ->orWhere("companyar",$request->name)
                    ->orWhere("companyen",$request->name)
                    ->orWhere("companytr",$request->name);
                $company = $company->where("name",$request->name)
                    ->orWhere("namear",$request->name)
                    ->orWhere("nameen",$request->name)
                    ->orWhere("nametr",$request->name);
            }
            $company = $company->first();
            $categories_data = $categories_data->paginate(12);
            $products = $products->paginate(12);
            if($company){
                foreach ($company->products as $pro){
                    $cats = Category::where('id',$pro->category_id)->distinct()->get(['id','name','image','translation']);
                }
                $categories_distinct = $cats;
                return view('website.categories.index', compact('categories_data', 'products','company','categories_distinct'));
            }elseif($categories_data->count() > 0 || $products->count() > 0){
                return view('website.categories.index', compact('categories_data', 'products','company'));
            }else{
                Alert::error('error msg',trans('custom.categories_not_found'));
                return redirect()->back();
            }

        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
        }
    }

    public function getProducts($id)
    {
        try {
            $category = Category::with(['subCategories' => function ($q) {
                $q->select("id", "name", "category_id",'translation','image');
            }])->where('id', $id)->first();
            return view('website.categories.products', compact('category'));
        } catch (\Exception $exception) {
            Alert::error("error msg", $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getAllProducts($id)
    {
        try {
            $subcategory = SubCategories::with(['products' => function ($q) {
                $q->select("id", "name", "category_id", "price", 'slug', 'sub_category_id','translation');
            }])->where('id', $id)->first();
            // dd( $subcategory->products);
            return view('website.subcategories.products', compact('subcategory'));
        } catch (\Exception $exception) {
            Alert::error("error msg", $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getOrders()
    {
        try {
            $orders = Sale::where("company_id", auth('company')->user()->id)
                ->with('details')
                ->get(['id', 'company_id', 'total_price', 'created_at', 'status', 'payment_statut', 'order_number']);
            return view('website.orders.index', compact('orders'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function orderDetails($id)
    {
        try {
            $details = SaleDetail::where('sale_id', $id)->get(['id', 'sale_id', 'cart_id']);
            return view('website.orders.details', compact('details'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function payment($id)
    {
        try {
            $order = Sale::where('id', $id)->first();
            return view('website.orders.payment', compact('order'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function showMessagesWithSuppliers()
    {
        try {
            $messages = ContactSupplier::where('user_id', auth('company')->user()->id)->get();
            $sender_messags = ContactSupplier::where('supplier_id', auth('company')->user()->id)->get();
            return view('website.user.suppliers_messages', compact('messages','sender_messags'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function sendMessageSupport(Request $request)
    {
        try {
            toast(trans('custom.message_success'), 'success');
            if ($request->ajax()){
                $support = new SupportChat();
                if ($request->document) {
                    $filename = time() . '.' . $request->document->extension();
                    $request->document->move(public_path('images/support-chat/'), $filename);
                    $support->files = $filename;
                }
                $support->company_id = $request->company_id;
                $support->company_id = $request->company_id;
                $support->message = $request->message;
                $support->sender = 'company';
                $support->save();
                return response($support);
            }
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getMessagesSupport(){
        if (auth('company')->user()){
            $support_chat = \App\Models\SupportChat::where('company_id',auth('company')->user()->id)
                ->get(['id','message','company_id','admin_id','sender']);
            return view('website.support_messages',compact('support_chat'));
        }
    }

    public function mediation()
    {
        try {
            $mediations = Mediation::get(['id', 'title', 'image', 'description']);
            return view('website.mediation.index', compact('mediations'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function tradeShow()
    {
        try {
            $tradeShow = TradeShow::get(['id', 'title', 'translation', 'details', 'image']);
            return view('website.tradeShow.index', compact('tradeShow'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function translationServices()
    {
        try {
            $translationServices = Translation::get(['id', 'title', 'description','image','translation']);
            return view('website.translationServices.index', compact('translationServices'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getTimelineOrders($order_number)
    {
        try {
            $order = Sale::where('company_id', auth('company')->user()->id)
                ->where('order_number', $order_number)
                ->first();
            return view('website.orders.timeline', compact('order'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getSupplierProfile($id)
    {
        try {
            $supplier = Company::where('id', $id)
                ->with('products', function ($q) {

                    $q->select('id', 'name', 'price', 'description', 'company_id', 'slug', 'translation');
                })
                ->first();
            $supplier->views = $supplier->views + 1;
            $supplier->save();
            return view('website.supplier.profile', compact('supplier'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function mediationRequest()
    {
        try {
            $companies = Company::get(['id', 'name']);
            $products = Product::get(['id', 'name']);
            return view('website.mediation.request', compact('companies', 'products'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function postMediationRequest(Store $request)
    {
        //        try{
        toast('send success', 'success');
        $request->validated();
        $mediation_requests = new MediationOrder();
        $mediation_requests->name = $request->name;
        $mediation_requests->company_id = $request->company_id;
        $mediation_requests->product_id = $request->product_id;
        $mediation_requests->company_name = $request->company_name;
        $mediation_requests->phone = $request->phone . $request->phone2;
        $mediation_requests->country_address = $request->country_address;
        $mediation_requests->qty = $request->qty;
        $mediation_requests->supply_period = $request->supply_period;
        $mediation_requests->email = $request->email;
        $mediation_requests->details = $request->details;
        $mediation_requests->save();
        return redirect()->back();
        //        }catch (\Exception $exception){
        //            Alert::error('error msg',$exception->getMessage());
        //            return redirect()->back();
        //        }
    }

    public function translationServicesRequest()
    {
        try {
            $companies = Company::get(['id', 'name']);
            return view('website.translationServices.request', compact('companies'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function postTranslationServicesRequest(TranslationServicesRequest $request)
    {
        try {
            $request->validated();
            toast('The request has been sent successfully', 'success');
            $input['name'] = $request->name;
//            $input['companyname'] = $request->companyname;
            $input['country_code'] = $request->country_code;
            $input['phone'] = $request->phone;
            $input['email'] = $request->email;
            $input['language'] = $request->language;
            $input['company_id'] = $request->company_id;
            $input['product_id'] = $request->product_id;
            $input['qty'] = $request->qty;
            $input['supply_period'] = $request->supply_period;
            $input['notes'] = $request->notes;
            TranslationServices::create($input);
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function membership()
    {
        try {
            $plans = Plan::get(['id', 'title', 'price', 'image', 'character_count', 'company_picture_count', 'product_count', 'product_picture_count', 'video_time', 'video_count']);
            return view('website.membership.index', compact('plans'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function helpCenter()
    {
        try {
            $help_center = HelpCenter::get(['id', 'title', 'description','image','translation']);
            return view('website.helpCenter.index', compact('help_center'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function policesRoles()
    {
        try {
            $rules = PolicieRule::get(['id', 'title', 'description', 'translation']);
            return view('website.policesRoles.index', compact('rules'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
        }
    }

    public function contactUs()
    {
        try {
            $setting = Setting::first();
            return view('website.contactus', compact('setting'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function postContactUs(ContactRequest $request)
    {
        try {
            toast('message sent success', 'success');
            $contact = Contact::create($request->validated());
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }


    public function getCompanyProducts($id)
    {
        $products = Product::where('company_id', $id)->get(['id', 'name', 'translation']);
        return json_encode($products);
    }

    public function planPayment()
    {
        return view('website.orders.payment');
    }

    public function getSuppliersBySubcategory($id)
    {
        try {
            $item = SubCategories::where('id', $id)
                ->with(['category', 'products'])
                ->orderBy('id', 'desc')
                ->first();
            foreach ($item->products as $product){
                $company = Company::where('id',$product->company_id)->distinct()->get();
            }
            $company_dist = $company;
            return view('website.subcategories.suppliers', compact('company_dist'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    // guest can send message to suppliers from product details page
    public function visitorContactSupplier(visitor_contact_supplier $request)
    {
        DB::beginTransaction();
        try {
            $request->validated();
            $visitor_create = Visitor::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $visitor = Visitor::where('id',$visitor_create['id'])->first();
            $contact_supplier = new ContactSupplier();
            if ($request->file('file')) {
                $filename = md5($request->file . microtime()) . '.' . $request->file->extension();
                $request->file->move(public_path('Attachments/'), $filename);
                $contact_supplier->file = $filename;
            }
            $contact_supplier->supplier_id = $request->supplier_id;        // الشركه البائع
            $contact_supplier->product_id = $request->product_id;
            // $contact_supplier->user_id        = $request->user_id ?? '';
            $contact_supplier->visitor_id = $visitor->id;   // زائر
            $contact_supplier->name = $visitor->name;
            $contact_supplier->email = $visitor->email;
            $contact_supplier->address = $request->address;
            $contact_supplier->message = $request->message;
            $contact_supplier->subject = $request->subject;
            // $contact_supplier->topic       = $request->topic;
            $contact_supplier->save();
            DB::commit();
            Alert::success(trans('contactSuppliers.success'), trans('contactSuppliers.smsendseller'));
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollback();
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    // get fav page
    public function getFavPage($id){
        try{
            $products = Favorite::where('company_id',$id)
                ->with(['product' => function($q){
                    $q->select('id','name','company_id','price','slug','translation');
                }])
                ->get();
            return view('website.buyer.fav',compact('products'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    // get edit profile page
    public function buyerEditProfile($id){
        try{
            $user = Company::where('id',$id)->first();
            return view('website.buyer.edit_profile',compact('user'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function buyerUpdateProfile(Request $request){
        try{
            Alert::success('success','done');
            $buyer = Company::where('id',$request->id)
                ->where('trade_role','buyer')
                ->first();
            $buyer->name = $request->name;
            $buyer->email = $request->email;
            $buyer->phone = $request->phone;
            $buyer->description = $request->description;
            $buyer->save();
            if($request->old_password){
                if(Hash::check($request->old_password,$buyer->password)){
                    $buyer->password = bcrypt($request->new_password);
                    $buyer->save();
                    Alert::success('success','تم تحديث كلمة المروور');
                    return redirect()->back();
                }else{
                    Alert::error('error msg','هناك خطأ فى كلمة المرور');
                    return redirect()->back();
                }
            }
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callbackToProvider($provider){
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = $this->createUser($getInfo,$provider);
        auth('company')->login($user);
        return redirect()->to('/');
    }
    function createUser($getInfo,$provider){
        $user = Company::where('provider_id',$getInfo->provider_id)
            ->where('trade_role','buyer')
            ->first();
        if (!$user) {
            $user = Company::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'trade_role' => 'buyer',
            ]);
        }
        return $user;
    }
}

