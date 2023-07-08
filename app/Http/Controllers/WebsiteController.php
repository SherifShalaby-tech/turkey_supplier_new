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
use App\Models\Currency;
use App\Models\Favorite;
use App\Models\HelpCenter;
use App\Models\Media;
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
use App\Models\ShipmentOrderNew;
use App\Models\ShipmentServices;
use App\Models\SubCategories;
use App\Models\SupportChat;
use App\Models\TradeShow;
use App\Models\Translation;
use App\Models\TranslationServices;
use App\Models\User;
use App\Models\Visitor;
use App\utils\helpers;
use Illuminate\Contracts\Session\Session;
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
use Svg\Tag\Rect;
use Aws\Rekognition\RekognitionClient;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        // if(app()->getLocale() == 'ar'){
        //     $cats = Category::orderBy('namear')->get(['id', 'name', 'translation']);
        // }elseif(app()->getLocale() == 'en'){
        //     $cats = Category::orderBy('nameen')->get(['id', 'name', 'translation']);
        // }elseif(app()->getLocale() == 'tr'){
        //     $cats = Category::orderBy('nametr')->get(['id', 'name', 'translation']);
        // }else{
            // $cats = Category::orderBy('translation->name')->get(['id', 'name', 'translation']);
        // }

        $helpers = new helpers();
        $code = $helpers->get_currency_co();
        $categories = Category::orderBy('translation->name')->get(['id', 'name', 'translation', 'image']);
        $trending_product = Product::where('trending', '!=', 0)
            ->take(12)
            ->orderBy('trending', 'DESC')
            ->latest()
            ->get(['id', 'name', 'price', 'category_id', 'slug', 'translation', 'trending']);
        // foreach ($trending_product as $trending_produc) {
        //     $new_price = $helpers->get_price($trending_produc->price);
        //     $trending_produc->price = $new_price;
        // }


        if (auth('company')->user()) {
            $products = SearchProduct::where('buyer_id', auth('company')->user()->id)
                ->with(['product' => function ($q) {
                    $q->orderBy('views', 'DESC');
                }])
                ->take(12)
                ->get(['id', 'product_id', 'buyer_id']);
        } else {
            $products = $trending_product;
        }
        // $top_rated_products = Product::select('products.*')
        //     ->Join('ratings', 'products.id', 'ratings.product_id')
        //     ->orderBy('ratings.rating', 'DESC')
        //     ->distinct('products.id')
        //     ->take(12)
        //     ->get(['id', 'name', 'price', 'category_id', 'slug', 'translation']);
        // foreach ($top_rated_products as $product) {
        //     $new_price = $helpers->get_price($product->price);
        //     $product->price = $new_price;
        // }
        // $best_sellers = Company::query()->where('trade_role', 'seller')
        //     ->select('id', 'name', 'phone', 'translation')
        //     ->take(6)
        //     ->get();
        // $latest_trade = Mediation::select(['id', 'title', 'image'])->latest()->first();
        $ads = Ad::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())->get(['id', 'image', 'title']);
        $services = Service::get(['id', 'name', 'description']);
        $mediation = Mediation::first();
        $translation = Translation::first();

        $real_products = Product::where('category_id', 50)->get(['id', 'name', 'slug']);
        $categories    = Category::take(6)->get();
        $sellers       = Company::where('trade_role', 'seller')->take(6)->get();
        return view('website.index', compact( 'ads', 'products', 'trending_product', 'translation',
                                              'services', 'mediation', 'code', 'real_products','categories', 'sellers'));
                                            //  $cats,$top_rated_products','best_sellers','latest_trade',
    }

    public function currencySession(Request $request)
    {
        if ($request->currency) {
            $currency = Currency::where('id', $request->currency)->first();
            request()->session()->put('currency', $currency);
            return back();
        }
    }

    public function buyerProfile($id)
    {
        try {
            $buyer = Company::where('id', $id)->first();
            $products = Favorite::where('company_id', $id)
                ->with(['product' => function ($q) {
                    $q->select('id', 'name', 'company_id', 'price', 'slug', 'translation');
                }])
                ->get();
            $helpers = new helpers();
            $code = $helpers->get_currency_co();
            foreach ($products as $product) {
                $new_price = $helpers->get_price($product->product->price);
                $product->product->price = $new_price;
            }
            return view('website.buyer.profile', compact('buyer', 'products', 'code'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getProductsYouMayLike()
    {
        try {
            if (auth('company')->user()) {
                $you_may_lilke_products = SearchProduct::where('buyer_id', auth('company')->user()->id)
                    ->with(['product' => function ($q) {
                        $q->orderBy('views', 'DESC')
                            ->select(['id', 'name', 'price', 'category_id', 'slug', 'translation']);
                    }])->latest()
                    ->paginate(12);
                $helpers = new helpers();
                $code = $helpers->get_currency_co();
                foreach ($you_may_lilke_products as $product) {
                    $new_price = $helpers->get_price($product->product->price);
                    $product->product->price = $new_price;
                }
                return view('website.products.you_may_like', compact('you_may_lilke_products', 'code'));
            } else {
                $products = Product::where('views', '!=', 0)
                    ->latest()
                    ->orderBy('views', 'DESC')
                    ->select(['id', 'name', 'price', 'category_id', 'slug', 'translation'])
                    ->paginate(12);
                $helpers = new helpers();
                $code = $helpers->get_currency_co();
                foreach ($products as $product) {
                    $new_price = $helpers->get_price($product->price);
                    $product->price = $new_price;
                }
                return view('website.products.you_may_like', compact('products', 'code'));
            }
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getTrendingProducts()
    {
        try {
            $products = Product::where('trending', '!=', 0)
                ->orderBy('trending', 'DESC')
                ->latest()
                ->select(['id', 'name', 'price', 'category_id', 'slug', 'translation'])
                ->paginate(12);

            $helpers = new helpers();
            $code = $helpers->get_currency_co();
            foreach ($products as $product) {
                $new_price = $helpers->get_price($product->price);
                $product->price = $new_price;
            }
            return view('website.products.trending_products', compact('products', 'code'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function getSellers(Request $request)
    {
        try {

            $sellers = Company::where('trade_role', 'seller')
                ->select('id', 'name', 'phone', 'namear', 'nameen', 'nametr')
                ->withcount('products');

            $products = Product::select('id', 'name', 'company_id', 'namear', 'nameen', 'nametr', 'companyar', 'companyen', 'companytr')
                ->with(['company:id,name,phone']);
            $category = Category::select('id', 'name', 'image', 'translation', 'namear', 'nameen', 'nametr')
                ->with(['products']);
            if ($request->name) {
                $category = $category->where("name", $request->name)
                    ->orwhere("namear", $request->name)
                    ->orwhere("nameen", $request->name)
                    ->orwhere("nametr", $request->name);
                $products = $products->where("name", $request->name)
                    ->orwhere("namear", $request->name)
                    ->orwhere("nameen", $request->name)
                    ->orwhere("nametr", $request->name)
                    ->orwhere("companyar", $request->name)
                    ->orwhere("companyen", $request->name)
                    ->orwhere("companytr", $request->name);
                $sellers = $sellers->where("name", 'like', '%' . $request->name . '%')
                    ->orWhere("namear", 'like', '%' . $request->name . '%')
                    ->orWhere("nameen", 'like', '%' . $request->name . '%')
                    ->orWhere("nametr", 'like', '%' . $request->name . '%');
            }
            $category = $category->first();
            $sellers = $sellers->paginate(28);
            $products = $products->paginate(12);
            $categoriesWithSellerCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
                ->select('categories.id', 'categories.name', 'categories.translation', 'categories.nametr', DB::raw('COUNT(DISTINCT companies.id) as seller_count'))
                ->groupBy('categories.id')
                ->get();

            if ($category) {
                $company = null;
                foreach ($category->products as $pro) {
                    $company = Company::where('id', $pro->company_id)->distinct()->get(['id', 'name', 'translation', 'phone']);
                }
                $company_distinct = $company;

                return view('website.supplier.index', compact('sellers', 'products', 'category', 'company_distinct', 'categoriesWithSellerCount'));
            } elseif ($sellers->count() > 0 || $products->count() > 0) {

                return view('website.supplier.index', compact('sellers', 'products', 'category', 'categoriesWithSellerCount'));
            } else {

                Alert::error('error msg', trans('custom.categories_not_found'));
                return view('website.supplier.index', compact('sellers', 'products', 'category'));
            }
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
        }
    }
    public function getFilterSellers(Request $request)
    {
        $html = "";
        if ($request->category) {
            $ctegorySubliers = Product::select('company_id', 'category_id')->whereIn('category_id', $request->category)->groupBy('company_id')->with(['company'])->get();
            $html =  view('website.supplier.filterSuppliers', compact('ctegorySubliers'))->render();
        }
        return $html;
    }

    public function getNewArrivals()
    {
        $categories = Category::has('products')->get(['id', 'name']);
        $new_arrivals = Product::orderBy('created_at', 'desc')->take(8)->latest()->get(['id', 'name', 'price', 'category_id']);
        return view('website.new_arrivals', compact('categories', 'new_arrivals'));
    }

    public function getProductDetails($id, $slug)
    {
        $product = Product::where("id", $id)->where("slug", $slug)->with('leadtimes')->first();
        // dd($product);
        $product->views = $product->views + 1;
        $product->save();
        if (auth('company')->user()) {
            if (!SearchProduct::where('buyer_id', auth('company')->user()->id)
                ->where('product_id', $product->id)
                ->exists()) {
                $productSearch = SearchProduct::create([
                    'product_id' => $product->id,
                    'buyer_id' => auth('company')->user()->id,
                ]);
            }
        }
        //add related products to you may like
        $related_products = Product::where('sub_category_id', $product->sub_category_id)
            ->whereNotIn('id', [$product->id])
            ->get();

        foreach ($related_products as $related_product) {
            if (auth('company')->user()) {
                if (!SearchProduct::where('buyer_id', auth('company')->user()->id)
                    ->where('product_id', $related_product->id)
                    ->exists()) {
                    $productSearch = SearchProduct::create([
                        'product_id' => $related_product->id,
                        'buyer_id' => auth('company')->user()->id,
                    ]);
                }
            }
        }
        $helpers = new helpers();
        $code = $helpers->get_currency_co();
        $new_price = $helpers->get_price($product->price);
        $product->price = $new_price;
        foreach ($product->leadtimes as $leadtime) {
            $new_lead_price = $helpers->get_price($leadtime->price);
            $leadtime->price = $new_lead_price;
        }
        $related_product = Product::where('sub_category_id', $product->sub_category_id)
            ->whereNotIn('id', [$product->id])
            ->paginate(8);
        foreach ($related_product as $re_product) {
            $new_price = $helpers->get_price($re_product->price);
            $re_product->price = $new_price;
        }

        $Other_products = Product::where('company_id', $product->company_id)->whereNotIn('id', [$product->id])->get(['id', 'name', 'price', 'category_id', 'description', 'company_id', 'translation', 'slug']);
        foreach ($Other_products as $Other_product) {
            $new_price = $helpers->get_price($Other_product->price);
            $Other_product->price = $new_price;
        }
        return view('website.products.details', compact('product', 'related_product', 'Other_products', 'code'));
    }


    public function searchProduct(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data_categories = Category::orwhere('namear', 'like', '%' . $request->name . '%')
                    ->orwhere('namear', $request->name)
                    ->orwhere('nameen', 'like', '%' . $request->name . '%')
                    ->orwhere('nameen', $request->name)
                    ->orwhere('nametr', 'like', '%' . $request->name . '%')
                    ->orwhere('nametr', $request->name)
                    ->orwhere('descen', 'like', '%' . $request->name . '%')
                    ->orwhere('descen', $request->name)
                    ->orwhere('descar', 'like', '%' . $request->name . '%')
                    ->orwhere('descar', $request->name)
                    ->orwhere('desctr', 'like', '%' . $request->name . '%')
                    ->orwhere('desctr', $request->name)
                    //                    ->orderBy('id','desc')
                    ->get(['name']);
                $data2 = Company::orwhere('namear', 'like', '%' . $request->name . '%')
                    ->orwhere('namear', $request->name)
                    ->orwhere('nameen', 'like', '%' . $request->name . '%')
                    ->orwhere('nameen', $request->name)
                    ->orwhere('nametr', 'like', '%' . $request->name . '%')
                    ->orwhere('nametr', $request->name)
                    ->orwhere('descen', 'like', '%' . $request->name . '%')
                    ->orwhere('descen', $request->name)
                    ->orwhere('descar', 'like', '%' . $request->name . '%')
                    ->orwhere('descar', $request->name)
                    ->orwhere('desctr', 'like', '%' . $request->name . '%')
                    ->orwhere('desctr', $request->name)
                    //                    ->orderBy('id','desc')
                    ->get(['name']);
                $data_products = Product::orwhere('namear', 'like', '%' . $request->name . '%')
                    ->orwhere('namear', $request->name)
                    ->orwhere('nameen', 'like', '%' . $request->name . '%')
                    ->orwhere('nameen', $request->name)
                    ->orwhere('nametr', 'like', '%' . $request->name . '%')
                    ->orwhere('nametr', $request->name)
                    ->orwhere('descen', 'like', '%' . $request->name . '%')
                    ->orwhere('descen', $request->name)
                    ->orwhere('descar', 'like', '%' . $request->name . '%')
                    ->orwhere('descar', $request->name)
                    ->orwhere('desctr', 'like', '%' . $request->name . '%')
                    ->orwhere('desctr', $request->name)
                    ->orwhere('companyar', 'like', '%' . $request->name . '%')
                    ->orwhere('companyar', $request->name)
                    ->orwhere('companyen', 'like', '%' . $request->name . '%')
                    ->orwhere('companyen', $request->name)
                    ->orwhere('companytr', 'like', '%' . $request->name . '%')
                    ->orwhere('companytr', $request->name)
                    ->orwhere('catar', 'like', '%' . $request->name . '%')
                    ->orwhere('catar', $request->name)
                    ->orwhere('caten', 'like', '%' . $request->name . '%')
                    ->orwhere('caten', $request->name)
                    ->orwhere('cattr', 'like', '%' . $request->name . '%')
                    ->orwhere('cattr', $request->name)
                    ->orwhere('subcatar', 'like', '%' . $request->name . '%')
                    ->orwhere('subcatar', $request->name)
                    ->orwhere('subcaten', 'like', '%' . $request->name . '%')
                    ->orwhere('subcaten', $request->name)
                    ->orwhere('subcattr', 'like', '%' . $request->name . '%')
                    ->orwhere('subcattr', $request->name)
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
            'id', 'name', 'detail', 'image', 'user_id', 'basic_shipping_service', 'translation'
        ]);
        return view('website.shipping.index', compact('shipping_services'));
    }

    public function shippingDetails($id)
    {
        $shipping = ShipmentServices::where('id', $id)->first();
        return view('website.shipping.details', compact('shipping'));
    }
    public function shippingOrder(Request $request)
    {
        // return $request;
        try {
            $this->validate($request, [
                'shipment_name' => 'nullable',
                'shipment_type' => 'nullable',
                'unit' => 'nullable',
                'length' => 'nullable',
                'width' => 'nullable',
                'height' => 'nullable',
                'dimensional_weight' => 'nullable',
                'weightunit' => 'nullable',
                'weight' => 'nullable',
                'package_no' => 'nullable',
                'destination' => 'nullable',
                'details' => 'nullable',
                'name' => 'required',
                'companyname' => 'nullable',
                'code' => 'nullable',
                'phone' => 'required_without:email',
                'email' => 'required_without:phone',

                'country' => 'nullable',
                'vendorname' => 'nullable',
                // 'vendoraddress' => 'nullable',
                'vendorphone' => 'nullable',
                'vendoremail' => 'nullable',
                'file' => 'nullable',
            ]);
            ShipmentOrderNew::create([
                "company_id"         => Auth::guard('company')->user()->id ?? null,
                "shipment_name"      => $request->shipment_name ?? '',
                "shipment_type"      => $request->shipment_type ?? '',
                "unit"               => $request->unit ?? '',
                "length"             => $request->length,
                "width"              => $request->width,
                "height"             => $request->height,
                "dimensional_weight" => $request->dimensional_weight,
                "weightunit"         => $request->weightunit ?? '',
                "weight"             => $request->weight,
                "package_no"         => $request->package_no,
                "destination"        => $request->destination,

                "name"               => $request->name,
                "companyname"        => $request->companyname,
                "code"               => $request->code,
                "phone"              => $_REQUEST['phone_number']['full'],
                "email"              => $request->email,

                'country'            => $request->country,
                'vendorname'         => $request->vendorname,
                'vendorphone'        => $request->vendorphone,
                'vendoremail'        => $request->vendoremail,
                'details'            => $request->details,
            ]);

            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect()->back();
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
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
            $products = Product::where('name', 'like', '%' . $request->name . '%')
                ->orWhere('namear', 'like', '%' . $request->name . '%')
                ->orWhere('nameen', 'like', '%' . $request->name . '%')
                ->orWhere('nametr', 'like', '%' . $request->name . '%')
                ->orWhere('description', 'like', '%' . $request->name . '%')
                ->orWhere('descen', 'like', '%' . $request->name . '%')
                ->orWhere('descar', 'like', '%' . $request->name . '%')
                ->orWhere('desctr', 'like', '%' . $request->name . '%')
                ->orWhere('companyar', 'like', '%' . $request->name . '%')
                ->orWhere('companyen', 'like', '%' . $request->name . '%')
                ->orWhere('companytr', 'like', '%' . $request->name . '%')
                ->orWhere('catar', 'like', '%' . $request->name . '%')
                ->orWhere('caten', 'like', '%' . $request->name . '%')
                ->orWhere('cattr', 'like', '%' . $request->name . '%')
                ->orWhere('subcatar', 'like', '%' . $request->name . '%')
                ->orWhere('subcaten', 'like', '%' . $request->name . '%')
                ->orWhere('subcattr', 'like', '%' . $request->name . '%')
                ->orderByRaw("CASE
                        WHEN products.name LIKE '%{$request->name}%' THEN 1
                        WHEN products.nameen LIKE '%{$request->name}%' THEN 1
                        WHEN products.namear LIKE '%{$request->name}%' THEN 1
                        WHEN products.nametr LIKE '%{$request->name}%' THEN 1
                        WHEN products.description LIKE '%{$request->name}%' THEN 2
                        WHEN products.descen LIKE '%{$request->name}%' THEN 2
                        WHEN products.descar LIKE '%{$request->name}%' THEN 2
                        WHEN products.desctr LIKE '%{$request->name}%' THEN 2
                        ELSE 3
                    END")
                ->paginate(12);
            $helpers = new helpers();
            $code = $helpers->get_currency_co();
            foreach ($products as $product) {
                $pro = Product::where('id', $product->id)->first();
                $pro->trending = $pro->trending + 1;
                $pro->save();
                $new_price = $helpers->get_price($product->price);
                $product->price = $new_price;

                if (auth('company')->user()) {
                    if (!SearchProduct::where('buyer_id', auth('company')->user()->id)
                        ->where('product_id', $product->id)
                        ->exists()) {
                        $productSearch = SearchProduct::create([
                            'product_id' => $product->id,
                            'buyer_id' => auth('company')->user()->id,
                        ]);
                    }
                }

                //add related products to you may like
                $related_products = Product::where('sub_category_id', $product->sub_category_id)
                    ->whereNotIn('id', [$product->id])
                    ->get();

                foreach ($related_products as $related_product) {
                    if (auth('company')->user()) {
                        if (!SearchProduct::where('buyer_id', auth('company')->user()->id)
                            ->where('product_id', $related_product->id)
                            ->exists()) {
                            $productSearch = SearchProduct::create([
                                'product_id' => $related_product->id,
                                'buyer_id' => auth('company')->user()->id,
                            ]);
                        }
                    }
                }
            }
            $categories = Category::where('name', 'like', '%' . $request->name . '%')
                ->orWhere('namear', 'like', '%' . $request->name . '%')
                ->orWhere('nameen', 'like', '%' . $request->name . '%')
                ->orWhere('nametr', 'like', '%' . $request->name . '%')
                //                ->orWhere('descen','like','%' .$request->name. '%')
                //                ->orWhere('descar','like','%' .$request->name. '%')
                //                ->orWhere('desctr','like','%' .$request->name. '%')
                //                ->orderBy('id','desc')
                ->paginate(12);
            $companies = Company::where('trade_role', 'seller')->where('name', 'like', '%' . $request->name . '%')
                ->orWhere('namear', 'like', '%' . $request->name . '%')
                ->orWhere('nameen', 'like', '%' . $request->name . '%')
                ->orWhere('nametr', 'like', '%' . $request->name . '%')
                ->orWhere('description', 'like', '%' . $request->name . '%')
                ->orWhere('descen', 'like', '%' . $request->name . '%')
                ->orWhere('descar', 'like', '%' . $request->name . '%')
                ->orWhere('desctr', 'like', '%' . $request->name . '%')
                ->orderByRaw("CASE
                        WHEN companies.name LIKE '%{$request->name}%' THEN 1
                        WHEN companies.nameen LIKE '%{$request->name}%' THEN 1
                        WHEN companies.namear LIKE '%{$request->name}%' THEN 1
                        WHEN companies.nametr LIKE '%{$request->name}%' THEN 1
                        WHEN companies.description LIKE '%{$request->name}%' THEN 2
                        WHEN companies.descen LIKE '%{$request->name}%' THEN 2
                        WHEN companies.descar LIKE '%{$request->name}%' THEN 2
                        WHEN companies.desctr LIKE '%{$request->name}%' THEN 2
                        ELSE 3
                    END")
                ->paginate(12);

            return view('website.products.result_search', compact('products', 'categories', 'companies', 'code'));
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

    public function downloadFiles($fileName)
    {
        try {
            $path = public_path('Attachments/' . $fileName);
            return \Illuminate\Support\Facades\Response::download($path);
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
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
        try {
            $categories_data = Category::select('id', 'name', 'image', 'translation', 'namear', 'nameen', 'nametr')->with(['products']);
            $products = Product::select('id', 'name', 'category_id', 'namear', 'nameen', 'nametr', 'companyar', 'companyen', 'companytr')->with(['category']);
            $company = Company::with('products')->select('id', 'name', 'phone', 'namear', 'nameen', 'nametr');
            if ($request->name) {
                $categories_data = $categories_data->where("name", "like", "%" . $request->name . "%")
                    ->orWhere("namear", "like", "%" . $request->name . "%")
                    ->orWhere("nameen", "like", "%" . $request->name . "%")
                    ->orWhere("nametr", "like", "%" . $request->name . "%");
                $products = $products->where("name", $request->name)
                    ->orWhere("namear", $request->name)
                    ->orWhere("nameen", $request->name)
                    ->orWhere("nametr", $request->name)
                    ->orWhere("companyar", $request->name)
                    ->orWhere("companyen", $request->name)
                    ->orWhere("companytr", $request->name);
                $company = $company->where("name", $request->name)
                    ->orWhere("namear", $request->name)
                    ->orWhere("nameen", $request->name)
                    ->orWhere("nametr", $request->name);
            }
            $company = $company->first();
            $categories_data = $categories_data->paginate(12);
            $products = $products->paginate(12);
            if ($company) {
                foreach ($company->products as $pro) {
                    $cats = Category::where('id', $pro->category_id)->distinct()->get(['id', 'name', 'image', 'translation']);
                }
                $categories_distinct = $cats;
                return view('website.categories.index', compact('categories_data', 'products', 'company', 'categories_distinct'));
            } elseif ($categories_data->count() > 0 || $products->count() > 0) {
                return view('website.categories.index', compact('categories_data', 'products', 'company'));
            } else {
                Alert::error('error msg', trans('custom.categories_not_found'));
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
        }
    }
    public function getFilterItems(Request $request)
    {
        $html = "";
        if ($request->category) {
            $subcategories = SubCategories::whereIn('category_id', $request->category)->get();
            $html =  view('website.categories.filterItem', compact('subcategories'))->render();
        }
        return $html;
    }

    public function getProducts($id)
    {
        try {
            $category = Category::with(['subCategories' => function ($q) {
                $q->select("id", "name", "category_id", 'translation', 'image');
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
                $q->select("id", "name", "category_id", "price", 'slug', 'sub_category_id', 'translation');
            }])->where('id', $id)->first();
            $helpers = new helpers();
            $code = $helpers->get_currency_co();
            foreach ($subcategory->products as $product) {
                $new_price = $helpers->get_price($product->price);
                $product->price = $new_price;
            }
            // dd( $subcategory->products);
            return view('website.subcategories.products', compact('subcategory', 'code'));
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
            $sender_messags = ContactSupplier::where('user_id', auth('company')->user()->id)->get();
            $messages = ContactSupplier::where('supplier_id', auth('company')->user()->id)->get();
            return view('website.user.suppliers_messages', compact('messages', 'sender_messags'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function sendMessageSupport(Request $request)
    {
        try {
            toast(trans('custom.message_success'), 'success');
            if ($request->ajax()) {
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

    public function getMessagesSupport()
    {
        if (auth('company')->user()) {
            $support_chat = \App\Models\SupportChat::where('company_id', auth('company')->user()->id)
                ->get(['id', 'message', 'company_id', 'admin_id', 'sender']);
            return view('website.support_messages', compact('support_chat'));
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
            $tradeShow = TradeShow::get(['id', 'title', 'translation', 'details', 'image', 'linkurl']);
            return view('website.tradeShow.index', compact('tradeShow'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function translationServices()
    {
        try {
            $translationServices = Translation::get(['id', 'title', 'description', 'image', 'translation']);
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
            $helpers = new helpers();
            $code = $helpers->get_currency_co();
            foreach ($supplier->products as $product) {
                $new_price = $helpers->get_price($product->price);
                $product->price = $new_price;
            }
            return view('website.supplier.profile', compact('supplier', 'code'));
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

        if ($request->company_id == "other") {
            $company = Company::firstOrCreate([
                "name" => $request->company_id
            ], [
                "password" => Hash::make("123456"),
                "type" => 'company',
                "trade_role" => 'buyer',
                "plan_id" => 1,
                "status" => 0,
            ]);
            if ($request->product_id == "other") {
                $product = Product::firstOrCreate([
                    "name" => $request->product_id,
                    "company_id" => $company->id,

                ], [
                    "trending" => 0,
                ]);
            }

            $company_id = $company->id;
            $product_id = $product->id;
        } else {
            $company_id = $request->company_id;
            $product_id = $request->product_id;
        }
        //        try{
        toast('send success', 'success');
        $request->validated();
        $mediation_requests = new MediationOrder();
        $mediation_requests->name = $request->name;
        $mediation_requests->company_id = $company_id;
        $mediation_requests->product_id = $product_id;
        $mediation_requests->company_name = $request->company_name;
        $mediation_requests->phone = $_REQUEST['phone_number']['full'];
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
            if ($request->company_id == "other") {
                $company = Company::firstOrCreate([
                    "name" => $request->company_id
                ], [
                    "password" => Hash::make("123456"),
                    "type" => 'company',
                    "trade_role" => 'buyer',
                    "plan_id" => 1,
                    "status" => 0,
                ]);
                if ($request->product_id == "other") {
                    $product = Product::firstOrCreate([
                        "name" => $request->product_id,
                        "company_id" => $company->id,

                    ], [
                        "trending" => 0,
                    ]);
                }

                $company_id = $company->id;
                $product_id = $product->id;
            } else {
                $company_id = $request->company_id;
                $product_id = $request->product_id;
            }
            $request->validated();
            toast('The request has been sent successfully', 'success');
            $input['name'] = $request->name;
            //            $input['companyname'] = $request->companyname;
            // $input['country_code'] = $request->country_code;
            $input['phone'] = $_REQUEST['phone_number']['full'];
            $input['email'] = $request->email;
            $input['language'] = $request->language;
            $input['company_id'] = $company_id;
            $input['product_id'] = $product_id;
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
            $help_center = HelpCenter::get(['id', 'title', 'description', 'image', 'translation']);
            $setting = Setting::first();
            return view('website.helpCenter.index', compact('help_center', 'setting'));
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
            foreach ($item->products as $product) {
                $company = Company::where('id', $product->company_id)->distinct()->get();
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
            $visitor_create = Visitor::where('email', $request->email)->first();
            if (!$visitor_create) {
                $visitor_create = Visitor::create([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }

            $visitor = Visitor::where('id', $visitor_create['id'])->first();
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
    public function getFavPage()
    {
        try {
            $products = Favorite::where('company_id', auth('company')->user()->id)
                ->with(['product' => function ($q) {
                    $q->select('id', 'name', 'company_id', 'price', 'slug', 'translation');
                }])
                ->get();
            $helpers = new helpers();
            $code = $helpers->get_currency_co();
            foreach ($products as $product) {
                $new_price = $helpers->get_price($product->product->price);
                $product->product->price = $new_price;
            }
            return view('website.buyer.fav', compact('products', 'code'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }
    // get edit profile page
    public function buyerEditProfile($id)
    {
        try {
            $user = Company::where('id', $id)->first();
            return view('website.buyer.edit_profile', compact('user'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function buyerUpdateProfile(Request $request)
    {
        try {
            Alert::success('success', 'done');
            $buyer = Company::where('id', $request->id)
                ->where('trade_role', 'buyer')
                ->first();
            $buyer->name = $request->name;
            $buyer->email = $request->email;
            $buyer->phone = $request->phone;
            $buyer->description = $request->description;
            $buyer->save();
            if ($request->new_password) {
                $buyer->password = bcrypt($request->new_password);
                $buyer->save();
            }
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callbackToProvider($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = $this->createUser($getInfo, $provider);
        auth('company')->login($user);
        return redirect()->to('/');
    }
    function createUser($getInfo, $provider)
    {
        $user = Company::where('provider_id', $getInfo->id)
            ->where('trade_role', 'buyer')
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

    public function changeCurrency(Request $request)
    {
        $products = Product::select('id', 'price')->get();
        foreach ($products as $product) {
            $product = Product::where('id', $product->id)->first();
            $product->price =  $product->price;
        }
    }

    public function buyerResetPassword(Request $request)
    {
        // return $request->_token;
        try {
            $buyer = Company::where('email', $request->email)
                ->orWhere('phone', $request->phone)
                ->exists();
            if ($buyer) {
                $buyer = Company::where('trade_role', 'buyer')->where('email', $request->email)
                    ->orWhere('phone', $request->phone)
                    ->first();

                Mail::send('website.buyer.new_password', ['token' => $request->_token], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->from(env('MAIL_FROM_ADDRESS'));
                    $message->subject('Reset Password');
                });
                Alert::success('success', 'We have e-mailed your password reset link!');
                return back();
                // return view('website.buyer.new_password',compact('buyer'));
            } else {
                dd('no');
            }
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function ResetPasswordView($token)
    {
        return view('auth.passwords.web_reset', ['token' => $token]);
    }
    public function ResetPassword(Request $request)
    {
        $update = Company::where(['email' => $request->email])->first();
        if (!$update) {
            Alert::error('error msg', 'Invalid token!');
            return back();
        }

        $user = Company::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        Alert::success('success', 'password changed successfully');
        return redirect()->route('webLogin');
    }

    public function searchWithImage(Request $request)
    {
        try {
            $file_name = time() . '_' . $request->image->getClientOriginalExtension();
            $path = public_path('images/products/' . $file_name);
            Image::make($request->image->getRealPath())->save($path);

            $client = new RekognitionClient([
                'version' => 'latest',
                'region' => 'us-east-1',
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);
            $imageData = file_get_contents($path);

            $result = $client->detectLabels([
                'Image' => [
                    'Bytes' => $imageData,
                ],
                'MaxLabels' => 10,
            ]);
            $labels = array_column($result['Labels'], 'Name');

            session()->put('labels', $labels);
            return redirect()->route('product.public.imagesearch.get');
        } catch (\Exception $exception) {
            Alert::error('error msg', __('home.error_imagesearch'));
            return redirect()->back();
        }

        // return view('website.products.img_search_result',compact('media','code'));
    }


    public function getsearchWithImage(Request $request)
    {

        $labels = session()->get('labels');
        if (!$labels) {
            return redirect()->route('website.index');
        }
        $media = Media::where(function ($query) use ($labels) {
            foreach ($labels as $label) {
                $query->orWhere('extracted_features', 'like', '%' . $label . '%');
            }
        })->whereHas('mediable')->with('mediable')->get()->unique('mediable_id')->map(function ($item) use ($labels) {
            $matchingCount = 0;
            foreach ($labels as $label) {
                if (strpos($item->extracted_features, $label) !== false) {
                    $matchingCount++;
                }
            }
            $item->matching_count = $matchingCount;
            return $item;
        })->filter(function ($item) {
            return $item->matching_count >= 5;
        })->sortByDesc('matching_count');
        // ->filter(function ($item) use ($labels) {
        //     $matchingCount = 0;
        //     foreach ($labels as $label) {
        //         if (strpos($item->extracted_features, $label) !== false) {
        //             $matchingCount++;
        //         }
        //     }
        //     return $matchingCount >= 5; // يتم تغيير القيمة هنا إلى 5 أو أكثر
        // })->sortByDESC(function ($item) use ($labels) {
        //     $matchingCount = 0;
        //     foreach ($labels as $label) {
        //         if (strpos($item->extracted_features, $label) !== false) {
        //             $matchingCount++;
        //         }
        //     }
        //     return $matchingCount;
        // });
        // ->sortByDESC(function ($item) use ($labels) {
        //         return array_search($item->extracted_features, $labels);
        //     });
        $helpers = new helpers();
        $code = $helpers->get_currency_co();
        // foreach($media as $key => $val){
        //     $new_price = $helpers->get_price($val->mediable->price);
        //     $val->mediable->price = $new_price;
        // }

        return view('website.products.img_search_result', compact('media', 'code'));
    }
}
