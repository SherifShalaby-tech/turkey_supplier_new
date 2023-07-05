@php
    $setting = \App\Models\Setting::first();
    $currencies = \App\Models\Currency::get();
    if(app()->getLocale() == 'ar'){
    $cats = App\Models\Category::orderBy('namear')->get(['id', 'name', 'translation']);
    }elseif(app()->getLocale() == 'en'){
        $cats = App\Models\Category::orderBy('nameen')->get(['id', 'name', 'translation']);
    }elseif(app()->getLocale() == 'tr'){
        $cats = App\Models\Category::orderBy('nametr')->get(['id', 'name', 'translation']);
    }else{
        $cats = App\Models\Category::orderBy('name')->get(['id', 'name', 'translation']);
    }
@endphp
<script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container-fluid">
                <div class="left-top-bar">
                    <a href="{{$setting->facebook}}" class="fs-18 cl10 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="{{$setting->linkedin}}" class="fs-18 cl10 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-linkedin"></i>
                    </a>

                    <a href="{{$setting->instagram}}" class="fs-18 cl10 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="{{$setting->youtube}}" class="fs-18 cl10 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-youtube"></i>
                    </a>
                </div>

                <div class="left-top-bar flex-w h-full">
                      <ul class="main-menu ">
                        <li class="dropdown-toggle">
                            <a href="#">  {{app()->getLocale()}}</a>
                            <ul class="sub-menu" style="@if (app()->getLocale() == 'ar') right: -65px; @endif">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li><a  href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                      </ul>

                      <ul class="main-menu">
                        <li class="dropdown-toggle">
                            @if (session()->get('currency'))
                                @if (session()->get('currency')->code == "TRY")
                                <a href="#"> TRY</a>
                                @else
                                <a href="#"> USD</a>
                                @endif
                            @else
                                <a href="#"> USD</a>
                            @endif
                            <ul class="sub-menu">
                            <form action="{{route('change.currency')}}" method="GET" >
                                @foreach ($currencies as $currency)
                                    <li><button  href="#" name="currency" value ="{{$currency->id}}"style="padding: 8px 20px" type="submit">{{$currency->code}}</button></li>
                                @endforeach
                            </form>

                            </ul>
                        </li>
                      </ul>
                </div>
            </div>
        </div>


        <div class="header">
            <div class="content-topbar  h-full container-fluid ">
                <div class="row" style=" display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap:
                             wrap; margin-right: -15px; margin-left: -15px; align-items: center;justify-content: center;align-content: center; ">

                    <div class="col-lg-4 col-md-4 col-12 wobble-horizontal">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="flex-c-m ">
                                <div class="col-lg-3 col-md-3 ">
                                <a class="logo-flex " href="{{route('website.index')}}">
                                    <img src="{{asset('website/imgs/Group.png')}}" style="width:100%">
                                </a>
                                </div>
                                <div class="col-lg-9 col-md-9 ">
                                <a href="{{route('website.index')}}" style="font-size: 22px;" class="cl1 ltext-108 hov1a">
                                    TURKEYSUPPLIERS.ONLINE
                                </a>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12" style="@if(app()->getLocale() == 'ar') margin-left: 0px; @endif" >
                        <div class="form  ">
                            <form  id="form" action="{{route('product.public.search')}}" method="GET">
                                <input required="required" autocomplete="off" name="name" type="search" class="form-control search-input" id="search"
                                 placeholder="{{trans('custom.What are you searching for')}} ?..."  >
                                 <a class="cl4" href="#" id="camBtn">  <img class="@if(app()->getLocale() == 'ar') img-se-ar @endif" width="25" src="{{asset('website/imgs/cam.png')}}"></a>
                                
                                <button class=" @if (app()->getLocale() == 'ar') btn-se-ar @endif" style="padding: 4px 4px 0 10px"
                                    type="submit">{{trans('custom.search')}} <i class="fa fa-search"></i>
                                </button>
                            </form>
                            <div id="product-result"></div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="options " style="display: flex;
                        flex-wrap: nowrap;
                        justify-content: center;
                        align-items: center;">
                            @if(Auth::guard('company')->user())
                                <ul class="main-menu">
                                    <li class="">
                                        <a href="#" class="social-icons icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11  js-show-cart">
                                            <img class="pulse-grow" src="{{asset('website/imgs/user.png')}}" >
                                        </a>
                                        <ul class="sub-menu" style="width: 200px">
                                            <li class="flex-link-header">
                                                <a href="#"> Welcome  {{Auth::guard('company')->user()->name  ?? null}} </a>
                                            </li>
                                            @if(Auth::guard('company')->user()->trade_role == 'seller')
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                                    <a href="{{route('admin.home')}}">{{trans('custom.mydash')}}</a>
                                                </li>
                                            @endif
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                                    <a href="{{route('user.orders')}}">{{trans('custom.orders')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Vector.png')}}"></span>
                                                    <a href="{{route('user.fav',auth('company')->user()->id)}}">{{trans('custom.fav')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 30.png')}}"></span>
                                                    <a href="{{route('buyer.profile',auth('company')->user()->id)}}">{{trans('custom.account')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><i class="fa fa-lock"></i></span>
                                                    <a href="{{route('web.logout')}}">{{trans('custom.logout')}}</a>
                                                </li>

                                        </ul>
                                    </li>
                                  </ul>
                            @endif

                            @if(Auth::guard('admin')->user())

                                <ul class="main-menu">
                                    <li class="dropdown-toggle">
                                        <a href="#" class="social-icons icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11  js-show-cart">
                                            <img class="pulse-grow" src="{{asset('website/imgs/user.png')}}" >
                                        </a>
                                        {{-- <a href="#">Welcome  {{Auth::guard('admin')->user()->name  ?? null}}  </a> --}}
                                        <ul class="sub-menu">
                                                <li class="flex-link-header">
                                                    <a href="#"> Welcome {{Auth::guard('admin')->user()->name  ?? null}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                                    <a href="{{route('admin.home')}}">{{trans('custom.mydash')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><i class="fa fa-lock"></i></span>
                                                    <a  href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                                        {{ __('custom.logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </li>
                                        </ul>
                                    </li>
                                  </ul>
                            @endif
                            <a href="{{route('messages.suppliers.show')}}"
                                class="social-icons icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11  js-show-cart  @if(Auth::guard('company')->user()) icon-header-noti @endif" 
                                data-notify=" @php 
                                use App\Models\ContactSupplier;
                            if(Auth::guard('company')->user()){
                                $messages = ContactSupplier::where('user_id', auth('company')->user()->id)->get();
                                if( $messages->count() == 0){ echo "0"; }
                                else{ echo  $messages->count(); }
                            }
                                @endphp"> <!--  icon-header-noti data-notify="2"-->
                                <img src="{{asset('website/imgs/chat-i.png')}}"  class="pulse-grow">
                            </a>

                            <a href="{{route('cart.get.products')}}" 
                                class="social-icons icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11   js-show-cart @if(Auth::guard('company')->user()) icon-header-noti @endif"
                                 data-notify="@php 
                                    use App\Models\Cart;
                                    use App\Models\CartDetails;
                                    if(Auth::guard('company')->user()){
                                    $cart = Cart::where('company_id',auth('company')->user()->id)
                                        ->where('status',0)
                                        ->first();
                                    if($cart){
                                          $details = CartDetails::where('cart_id',$cart->id)->where('status',0)->with('product.leadtimes')->get();
                                          if( $details->count() == 0 ){ echo "0"; }
                                          else{ echo  $details->count(); }
                                    }}
                                 @endphp" >
                                <img src="{{asset('website/imgs/cart3.png')}}"   class="pulse-grow" >
                                
                           
                            </a>
                 
                         
                            <a href="{{route('user.fav')}}" class=" social-icons dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 
                            @if(Auth::guard('company')->user()) icon-header-noti @endif" 
                                data-notify=" @php 
                                use App\Models\Favorite;
                                if(Auth::guard('company')->user()){
                                    $products = Favorite::where('company_id',auth('company')->user()->id);
                                    if( $products->count() == 0){ echo "0"; }
                                    else{ echo  $products->count(); }
                                }
                                @endphp">
                                <img src="{{asset('website/imgs/favorite.png')}}"   class="pulse-grow">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="wrap-menu-desktop">
            @include('layouts.website.navbar')
        </div>
    </div>



    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
{{--        <div class="logo-mobile">--}}
{{--            <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>--}}
{{--=======--}}
        <!-- Logo moblie -->
        <div class="logo-mobile flex-w">
            <a class="logo-flex " href="{{route('website.index')}}">
                <img class="pulse-grow " src="{{asset('website/imgs/Group.png')}}" style="width: 70px;
                height: 70px !important;
                max-height: 70px !important;">
                <p class="cl1 mtext-112 hov1a m-l-70"> TURKEYSUPPLIERS.ONLINE</p>
            </a>
        </div>

        <!-- Icon header -->


        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>
    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar ">

                    <div class="flex-link-header">
                        <a href="{{$setting->facebook}}" class="fs-18 cl0 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="{{$setting->linkedin}}" class="fs-18 cl0 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-linkedin"></i>
                        </a>

                        <a href="{{$setting->instagram}}" class="fs-18 cl0 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-instagram"></i>
                        </a>

                        <a href="{{$setting->youtube}}" class="fs-18 cl0 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-youtube"></i>
                        </a>


                        <div class="options " style="display: flex;
                        flex-wrap: nowrap;
                        justify-content: center;
                        align-items: center;">
                            @if(Auth::guard('company')->user())


                                <ul class="main-menu">
                                    <li class="">
                                        <a href="#" class="social-icons icon-header-item cl2 hov-cl1 trans-04  js-show-cart bg1 bor2">
                                            <img class="pulse-grow p-tb-7 p-lr-7 " src="{{asset('website/imgs/user.png')}}" >
                                        </a>

                                        <ul class="sub-menu" style="width: 200px">
                                            <li class="flex-link-header">
                                                <a href="#"> Welcome  {{Auth::guard('company')->user()->name  ?? null}} </a>
                                            </li>
                                            @if(Auth::guard('company')->user()->trade_role == 'seller')
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                                    <a href="{{route('admin.home')}}">{{trans('custom.mydash')}}</a>
                                                </li>
                                            @endif
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                                    <a href="{{route('user.orders')}}">{{trans('custom.orders')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Vector.png')}}"></span>
                                                    <a href="{{route('user.fav',auth('company')->user()->id)}}">{{trans('custom.fav')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 30.png')}}"></span>
                                                    <a href="{{route('buyer.profile',auth('company')->user()->id)}}">{{trans('custom.account')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><i class="fa fa-lock"></i></span>
                                                    <a href="{{route('web.logout')}}">{{trans('custom.logout')}}</a>
                                                </li>

                                        </ul>
                                    </li>
                                  </ul>
                            @endif

                            @if(Auth::guard('admin')->user())

                                <ul class="main-menu">
                                    <li class="">
                                        <a href="#" class="social-icons icon-header-item cl2 hov-cl1 trans-04  js-show-cart bg1 bor2">
                                            <img class="pulse-grow p-tb-7 p-lr-7 " src="{{asset('website/imgs/user.png')}}" >
                                        </a>

                                        {{-- <a href="#">Welcome  {{Auth::guard('admin')->user()->name  ?? null}}  </a> --}}
                                        <ul class="sub-menu">
                                                <li class="flex-link-header">
                                                    <a href="#"> Welcome   {{Auth::guard('admin')->user()->name  ?? null}}  </a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                                    <a href="{{route('admin.home')}}">{{trans('custom.mydash')}}</a>
                                                </li>
                                                <li class="flex-link-header">
                                                    <span><i class="fa fa-lock"></i></span>
                                                    <a  href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                                        {{ __('custom.logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </li>
                                        </ul>
                                    </li>
                                  </ul>
                            @endif

                            <a href="{{route('messages.suppliers.show')}}"
                                class="social-icons icon-header-item cl2 hov-cl1 trans-04 bg1 bor2  js-show-cart" > <!--  icon-header-noti data-notify="2"-->
                                <img src="{{asset('website/imgs/chat-i.png')}}"  class="pulse-grow p-tb-7 p-lr-7">
                            </a>

                            <a href="{{route('cart.get.products')}}"
                                class="social-icons icon-header-item cl2 hov-cl1 trans-04 bg1 bor2  js-show-cart" >
                                <img src="{{asset('website/imgs/cart3.png')}}"   class="pulse-grow p-tb-7 p-lr-7">
                            </a>

                            <a href="#"
                                class=" social-icons dis-block icon-header-item cl2 hov-cl1 trans-04 bg1 bor2  js-show-cart">
                                <img src="{{asset('website/imgs/favorite.png')}}"   class="pulse-grow p-tb-7 p-lr-7">
                            </a>

                        </div>
                    </div>



                    <div class="flex-w">
                        <ul class="main-menu ">
                            <li class="dropdown-toggle">
                                <a href="#">  {{app()->getLocale()}}</a>
                                <ul class="sub-menu">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li><a  href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                          </ul>


                         {{--  <ul class="main-menu">
                            <li class="dropdown-toggle">
                                <a href="#"> USD</a>
                                <ul class="sub-menu">
                                    <li><a  href="#">#</a></li>
                                </ul>
                            </li>
                          </ul>--}}
                    </div>

                </div>
            </li>

            <li>
                <div class="right-top-bar">


                      <div class="wrap-icon-header ">
                        <div class="form  ">
                            <form  id="form" action="{{route('product.public.search')}}" method="GET">
                                <input required="required" autocomplete="off" name="name" type="search" class="form-control search-input" id="search"
                                 placeholder="{{trans('custom.What are you searching for')}} ?..."  style="font-size: 15px !important;">
                                 <img class="@if(app()->getLocale() == 'ar') img-se-ar @endif" width="25" src="{{asset('website/imgs/cam.png')}}">
                                <button class=" @if (app()->getLocale() == 'ar') btn-se-ar @endif"
                                    type="submit">{{trans('custom.search')}} <i class="fa fa-search"></i>
                                </button>
                            </form>
                            <div id="product-result"></div>
                        </div>

                    </div>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <ul class="main-menu">

                <li class="dropdown-toggle">
                    <a href="#">{{trans('custom.categories')}}</a>
                    <ul class="sub-menu scroll-sub-menu">
                        @if($cats->count() > 0)
                            @foreach($cats as $category)
                                <li>
                                    <a href="{{route('category.products',$category->id)}}"> {{$category->name}}</a>
                                    <ul class="sub-menu">
                                        @if($category->subCategories->count() > 0)
                                            @foreach($category->subCategories as $sub)
                                                <li><a href="{{route('subcategory.products',$sub->id)}}">{{$sub->name}}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            </ul>
            <li>
                <a href="{{route('website.index')}}">{{trans('custom.home')}}</a>
            </li>

            <li>
                <a href="{{route('mediation')}}">{{trans('custom.mediation')}}</a>
            </li>

            <li>
                <a href="{{route('translationServices')}}">{{trans('custom.translation_services')}}</a>
            </li>

            <li>
                <a href="{{route('tradeShow')}}">{{trans('tradeshows.tradeshows')}}</a>
            </li>

            <li>
                <a href="{{route('shipping')}}">{{trans('custom.shipping')}}</a>
            </li>

            <li>
                <a href="{{route('membership')}}">{{trans('site.sub')}}</a>
            </li>
            @check_guard
            <li>
                <a href="{{route('webLogin')}}">{{trans('custom.login')}}</a>
            </li>

            <li>
                <a href="{{route('webRegister')}}">{{trans('custom.register')}}</a>
            </li>
            @endcheck_guard
            <li>
                <a href="{{route('about_us')}}">{{trans('custom.about_us')}}</a>
            </li>
        </ul>
    </div>

<!-- The Modal -->
<div id="imageModal" style="display: none" class="modal flex-c-m">

    <!-- Modal content -->
    <div class=" img9 flex-c-m" style=" position: relative; top: 20%;">
        <div class="modal-content flex-c-m" style="    background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;">

            <span class="close-img" style="color: #aaaaaa;
            font-size: 33px;
            font-weight: bold;
            position: relative;
            left: 47%;">&times;</span>
            <div class="p-b-10 p-t-30">
                <form class="form aForm" id="a-form" action="{{ route('product.public.imagesearch') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 p-lr-100 ">
                            <h3>Upload Image</h3>
                            <canvas id= "canv1" style="height: 175px;
                            border-style: solid;
                            border-width: 1px;
                            border-color: black;"></canvas>

                            <p>
                            Filename:
                            <input type="file" name="image" multiple="false" accept="image/*" id=finput onchange="upload()">
                            </p>
                        </div>


                    </div>
                    <div class="row mt-2 p-t-30">
                        <div class="col-md-12 txt-center">
                            <div class="form-group mtext-1075">
                                <button type="submit" class="btn bg1 cl0 p-tb-18 p-lr-100 bor2color" >{{trans('custom.search')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>

    // Get the modal
    var imgmodal = document.getElementById("imageModal");

    // Get the button that opens the modal
    var cambtn = document.getElementById("camBtn");

    // Get the <span> element that closes the modal
    var span2 = document.getElementsByClassName("close-img")[0];

    // When the user clicks the button, open the modal
    cambtn.onclick = function() {
        imgmodal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span2.onclick = function() {
        imgmodal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == imgmodal) {
        imgmodal.style.display = "none"; 
    }
    }
    function upload(){
  var imgcanvas = document.getElementById("canv1");
  var fileinput = document.getElementById("finput");
  var image = new SimpleImage(fileinput);
  image.drawTo(imgcanvas);
}
</script>
</header>
