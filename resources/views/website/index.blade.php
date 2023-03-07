@extends('layouts.website.master')
@section('title', 'Home Page')
@section('css')
<style>

        .mySwiper:hover{
            transform: translateY(-5px);
            transition-duration: .5s;
            box-shadow: 0px 10px 20px 2px rgba(0, 0, 0, 0.25);
        }

        a{
            text-decoration: none !important;
        }
        .titleProduct{
            font-size: 20px;
            width: fit-content;
            margin-bottom: 40px !important;
        }
        .offset {
            border-bottom: #3797b1 3px solid;
        }

        .customer-elctroinc .btn:active, :hover, :focus {
        outline: 0!important;
        outline-offset: 0;
        }
        .customer-elctroinc .btn::before,
        ::after {
        position: absolute;
        content: "";
        }

        .customer-elctroinc .btn {
        position: relative;
        display: inline-block;
        height: auto;
        background-color:  #4cb2cd;
        border: none;
        cursor: pointer;
        margin: 50px auto 14px;
        min-width: 160px;
        width: fit-content;
        }
        .customer-elctroinc .btn p {
            position: relative;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            top: 0; left: 0;
            width: 100%;
            padding: 15px 20px;
            transition: 0.3s;
        }
        /*--- btn-3 ---*/
        .customer-elctroinc .btn-3 {
        padding: 5px 10px;
        }

        .customer-elctroinc .btn-3::before,
        .btn-3::after {
        background: transparent;
        z-index: 2;
        }
        /* 11. hover-border-1 */
        .customer-elctroinc .btn.hover-border-1::before,
        .btn.hover-border-1::after {
        width: 10%; height: 25%;
        transition: 0.35s;
        }
        .customer-elctroinc .btn.hover-border-1::before {
        top: 0; left: 0;
        border-left: 1px solid rgb(28, 31, 30);
        border-top: 1px solid rgb(28, 31, 30);
        }
        .customer-elctroinc .btn.hover-border-1::after {
        bottom: 0; right: 0;
        border-right: 1px solid rgb(28, 31, 30);
        border-bottom: 1px solid rgb(28, 31, 30);
        }
        .customer-elctroinc .btn.hover-border-1:hover::before,
        .btn.hover-border-1:hover::after {
        width: 99%;
        height: 98%;
        }
    /* */



            .wrapper {
            height: 250px;
            padding: 0;
        border-radius: 7px 7px 7px 7px;
        /* VIA CSS MATIC https://goo.gl/cIbnS */
        -webkit-box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
        }

        .product-img img {
        border-radius: 7px 0 0 7px;
        }
        .customer-elctroinc .elc-one-data,.elc-data-ar {
            background-color: transparent;
            padding: 0 ;
            border: none ;

        }
        .wrapper .product-text h1 {
        margin: 0 0 0 38px;
        padding-top: 10px;
        font-size: 22px;
        color: #474747;
        }
        .wrapper .product-text h1,
        .product-price-btn p {
        font-family: 'Bentham', serif;
        }

        .wrapper .product-text p {
        height: 125px;
        margin: 0 0 0 38px;
        font-family: 'Playfair Display', serif;
        color: #8d8d8d;
        line-height: 1.7em;
        font-size: 15px;
        font-weight: lighter;
        overflow: hidden;
        }

        .mediation-div{
            margin-top: 20px;
        }

    .container {
        width: 100% !important;
    }

    .card-title-name{
        width: 272px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0 !important;
        font-size: 25px ;
    }



    .style-container .best-seller-img p{
        color: #fff;
        font-weight: 100 !important;
        font-size: 25px;
        letter-spacing: 1.5px;
    }
    .style-container .swiper-slide p{
        color: #3797b1 !important;
    }

        /* */

        .scroll-toggle {
            align-items: center;
            background-color: var(--light);

            display: flex;
            max-width: 680px;
            justify-content: center;
            width: 90%;
            margin-left: 4%;
        }

        .scroll-toggle__list {
            display: flex;
            flex: 1 1 auto;
            overflow-x: scroll;
        }
        .scroll-toggle__list-item {
            flex: 0 0 auto;
            padding: 10px 0;
            text-decoration: none;
            list-style: none;
        }
        .scroll-toggle__list-item a{
             padding: 0 4px;
             font-size: 18px;
        }
        .scroll-toggle__list-item a:hover{
            color: #3797b1;
        }

        /* */
        .display-n-d{
            display: none;
        }
        .swiper-slide{
            width: 330px;
            height: 374px;
            padding:5px 10px 0px 10px;
            filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));
        }
        .swiper-wrapper{
            padding: 0 10px;
        }
        .carousel-indicators{
            display: none;
        }

        .service-p{
            position: relative;
            color: white;
            text-align: center;
            background-color: #fff;
            color:#3797b1;
            border:#3797b1 1px solid;
            padding: 4px;
            border-radius: 7px;
        }
    @media (max-width: 980px) {
        .style-container .container {
           max-width: 900px !important;
         }
         .style-container .swiper .swiper-slide{
             height: 250px !important;
         }
         .style-container .swiper .suppliers-slide{
             height: 250px !important;
         }
         .card-title-name{
                /*-webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                display: -webkit-box;
                overflow: hidden;
                text-overflow: ellipsis;*/
            }
         .style-container .swiper .swiper-slide img{
            height: 180px !important;
         }

    }
    @media (max-width: 576px) {
        .ads-div{
            margin: 10px 0;
        }
        .style-container .row{
           /* flex-direction: column-reverse; */
        }

    }
    @media (max-width: 480px) {
        .tracking-order .container-fluid .row{
            margin: 0 !important;
            padding: 0 !important;
        }

        .swiper-slide{
            width: 330px;
            height: 374px;
            padding:5px 10px 0px 10px;
            filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));
        }
    }
    @media (max-width: 425px) {
        .display-n-m{
            display: none;
        }
        .ads-div{
            height:200px !important;
        }
        .ads-div img{
            height: 200px !important;
        }
        .display-n-d{
          display: block;
        }
        .swiper-slide{
         padding:5px 4px 0 0 !important;
         box-shadow: rgba(255, 255, 255, 0) 0px 0px 0px;
        }
        .sw-s-ar{
            margin-left: 10px !important;
        }
        .effect8
        {
            position:relative;
            box-shadow: rgba(255, 255, 255, 0) 0px 0px 0px;
        }

       /* .swiper-slide::after{
            content:"";
            background: #3797b1;
            position: absolute;
            bottom: 0;
            left: 0;
            height: 100%;
            width: 1.5px;
        }*/
        .swiper-slide:first-child:after
        {
          display: none;
        }
        .right-div img{
            height: 200px !important;
            margin-top: 10px;
        }
        .service-p{
             font-size: 24px !important;
        }

    }
    @media (max-width: 375px) {
        .display-n-m{
            display: none;
        }
        .ads-div{
            height:200px !important;
        }
        .ads-div img{
            height: 200px !important;
        }
        .display-n-d{
          display: block;
        }
        .swiper-slide{
         padding:5px 10px 0px 10px;
         box-shadow: rgba(255, 255, 255, 0) 0px 0px 0px;

        }
        .effect8
        {
            position:relative;
            box-shadow: rgba(255, 255, 255, 0) 0px 0px 0px;
        }
        .card-title-name{
            font-size: 20px;
        }
        .swiper-slide:first-child:after
        {
          display: none;
        }
        .right-div img{
            height: 200px !important;
            margin-top: 10px;
        }

        .service-p{
             font-size: 20px !important;
        }
    }
    @media (max-width: 320px) {
        .display-n-m{
            display: none;
        }
        .ads-div{
            height:200px !important;
        }
        .ads-div img{
            height: 200px !important;
        }
        .display-n-d{
          display: block;
        }
        .swiper-slide{
         padding:5px 10px 0px 10px;
         box-shadow: rgba(255, 255, 255, 0) 0px 0px 0px;

        }
        .effect8
        {
            position:relative;
            box-shadow: rgba(255, 255, 255, 0) 0px 0px 0px;
        }
        .card-title-name{
            font-size: 20px;
        }
        .swiper-slide:first-child:after
        {
          display: none;
        }
        .right-div img{
            height: 200px !important;
            margin-top: 10px;
        }

        .service-p{
            font-size: 20px !important;
            position: relative;
            color: white;
            text-align: center;
            background-color: #fff;
            color:#3797b1;
            border:#3797b1 1px solid;
            padding: 4px;
            border-radius: 7px;
        }
    }

</style>
@stop
@section('content')
@php
    $categories = \App\Models\Category::orderBy("translation->name")->get(['id','name','translation']);
@endphp
    <div class="scroll-toggle display-n-d">
            <ul class="scroll-toggle__list">
                    @if($categories->count() > 0)
                    <li class="scroll-toggle__list-item">
                        <a class="dropdown-item" href="{{route('categories.index')}}"> {{ trans('custom.all') }} | </a>
                    </li>
                        @foreach($categories as $category)
                            <li class="scroll-toggle__list-item">
                                <a class="dropdown-item" href="{{route('category.products',$category->id)}}"> {{$category->name}} | </a>
                            </li>
                        @endforeach
                    @endif
            </ul>
    </div>
    <!-- tracking order-->
    <div class="tracking-order style-container">
        <div class="container @if (app()->getLocale() == 'ar') container-ar @endif">
            <div class="row" style="display: flex; flex-wrap: wrap;   align-items: center; padding: 25px 10px;
            box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px;">

                <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div display-n-m">
                    <div class="img-three shipping-div " >
                        <a href="{{ route('shipping') }}" >
                             {{--   <p style="text-decoration: none;position: relative;top: 20px;font-size: 20px">{{trans('custom.shipping')}}</p> --}}
                            <div class="img-three">
                                <img src="{{ asset('website/imgs/shipping.jpeg') }}" title="{{ trans('custom.shipping') }}"
                                style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                margin-bottom: 5px;" >

                                <p class="service-p">{{ trans('custom.shipping') }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="img-three mediation-div " >
                        <a href="{{ route('mediation') }}">
                            @if($mediation)
                                <img src="{{ asset('images/mediations/' . $mediation->image) }}" title="{{ trans('custom.mediation') }}"
                                     style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                margin-bottom: 5px;" title="meditation">
                            @else
                                <img src="{{ asset('images/mediations/74366467144.jpg') }}" title="{{ trans('custom.mediation') }}"
                                     style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                margin-bottom: 5px;" title="meditation">
                            @endif

                            <p class="service-p">{{ trans('custom.mediation') }}
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-12 " style="box-shadow: rgba(0, 0, 0, 0.2) 0px 18px 50px -10px; padding:0; height:470px; ">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @isset($ads)
                                @foreach ($ads as $key => $ad)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        @if ($ad->image)
                                            <img class="d-block w-100 pop" src="{{ asset('images/ads/' . $ad->image) }}"
                                                alt="First slide"
                                                style="max-width: 100%;  height: 470px;width: 100% !important;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: 50% 50%;
                                                border-radius: 10px;
                                                ">
                                        @else
                                            <img class="d-block w-100" src="{{ asset('images/ads/active.png') }}"
                                                alt="First slide">
                                        @endif
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 wobble-horizontal right-div">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @php
                                $real_products = \App\Models\Product::where('sub_category_id',278)->get(['id','name','slug']);
                            @endphp
                            @foreach($real_products as $key => $product)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    @if($product->firstMedia)
                                        <a href="{{ route('product.details',$product->slug) }}">
                                            <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" title="{{ trans('custom.Real Estates') }}"
                                                 style=" border-radius: 7px;  height: 410px  ; width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        margin-bottom: 5px;" title="meditation">
                                        </a>
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                    @endif
                                        <p  class="service-p">{{ trans('custom.Real Estates') }}</p>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of tracking order -->

    <!-- Swiper trending-product -->
    <div class="style-container">
        <div class="container @if (app()->getLocale() == 'ar') container-ar @endif">
            <div class="row" style=" text-transform: uppercase;">
                <div class="swiper mySwiper best-sellers customer-elctroinc ">
                    <div class="best-seller-img">
                        <a href="{{route('getTrendingProducts')}}" style="color: #333">
                            <p class=" btn btn-3 hover-border-1 wobble-horizontal ">{{trans('custom.trending_product')}}</p>
                        </a>
                    </div>
                    <div class="swiper-wrapper">
                        @isset($trending_product)
                            @foreach ($trending_product as $product)
                                <div class="swiper-slide effect8  @if (app()->getLocale() == 'ar') sw-s-ar @endif">
                                    <div class=" isotope-item women" style="display: flex;">
                                        <div class="block2" >
                                           <a href="{{ route('product.details',$product->slug) }}">
                                            <div class="block2-pic hov-img0  flex-w flex-c p-t-14">

                                                    @if($product->firstMedia)
                                                        <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                        style="max-width: 100%;  height: 254px ;width:  300px !important;
                                                        background-size: cover;
                                                        background-repeat: no-repeat;
                                                        background-position: 50% 50%;
                                                        border-radius: 7px;
                                                        display: flex; " >
                                                    @else
                                                    <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                                    @endif

                                            </div>
                                             </a>

                                            <div class="block2-txt flex-w flex-t p-t-14" >
                                                <div class="block2-txt-child1 flex-col-l ">
                                                    <span class="stext-105 cl7" style="text-align: start;">
                                                        <a class=" cl7 hov-cl1" href="{{ route('product.details', $product->slug) }}">
                                                            <h3 class="flex-t card-title trans-04 js-name-b2 p-b-6 card-title-name" >{{$product->name}}</h3>
                                                            <h4 class="flex-t card-title trans-04 js-name-b2 p-b-6 price_text"> {{trans('custom.price')}} : ${{$product->price}}</h4>
                                                        </a>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Swiper Sellers -->
    <div class="style-container">
        <div class="container @if (app()->getLocale() == 'ar') container-ar @endif">
            <div class="row" style=" text-transform: uppercase;">
                <div class="swiper mySwiper new-arrivals customer-elctroinc ">
                    <div class="best-seller-img">
                        <a href="{{route('getSellers')}}" style="color: #333">
                            <p class="  btn btn-3 hover-border-1 wobble-horizontal ">
                                {{trans('custom.suppliers')}}
                            </p>
                        </a>
                    </div>
                    <div class="swiper-wrapper">
                        @isset($best_sellers)
                            @foreach ($best_sellers as $company)
                                <div class="swiper-slide effect8 suppliers-slide" >
                                    <div class=" isotope-item women" style="display: flex;">
                                        <div class="block2" >
                                            <a href="{{ route('supplier.profile', $company->id) }}">
                                                <div class="block2-pic hov-img0  flex-w flex-c p-t-14">
                                                    @if($company->firstMedia)
                                                            <img src="{{ asset('images/companies/' . $company->firstMedia->file_name) }}" class="img-fluid w-100"
                                                            style="max-width: 100%;  height: 300px ;width:  300px !important;
                                                            background-size: cover;
                                                            background-repeat: no-repeat;
                                                            background-position: 50% 50%;
                                                            border-radius: 7px;
                                                            display: flex; " >
                                                        @else
                                                        <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                        style="max-width: 100%;  height: 300px ;width:  300px !important;
                                                        background-size: cover;
                                                        background-repeat: no-repeat;
                                                        background-position: 50% 50%;
                                                        border-radius: 7px;
                                                        display: flex; ">
                                                        @endif
                                                </div>
                                            </a>
                                            <div class="block2-txt flex-w flex-t p-t-14" >
                                                <div class="block2-txt-child1 flex-col-l ">
                                                    <span class="stext-105 cl7" style="text-align: start;">
                                                        <a class=" cl7 hov-cl1" href="{{ route('supplier.profile', $company->id) }}">
                                                            <h3 class="flex-t card-title trans-04 js-name-b2 p-b-6 card-title-name" >{{ $company->name }}</h3>
                                                        </a>
                                                     </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Swiper products -->
    <div class="style-container">
        <div class="container @if (app()->getLocale() == 'ar') container-ar @endif">
            <div class="row" style=" text-transform: uppercase;">
                <div class="swiper mySwiper best-sellers customer-elctroinc">
                    <div class="best-seller-img">
                        <a href="{{route('getProductsYouMayLike')}}" style="color: #333">
                            <p class="  btn btn-3 hover-border-1 wobble-horizontal ">
                                {{trans('custom.you_may_like')}}
                            </p>
                        </a>
                    </div>
                    <div class="swiper-wrapper">
                        @if(!auth('company')->user())
                            @isset($trending_product)
                                @foreach ($trending_product as $product)
                                    <div class="swiper-slide effect8">
                                        <div class=" isotope-item women" style="display: flex;">
                                            <div class="block2" >
                                                <a href="{{ route('product.details',$product->slug) }}">
                                                    <div class="block2-pic hov-img0  flex-w flex-c p-t-14">

                                                        @if($product->firstMedia)
                                                            <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                                 style="max-width: 100%;  height: 254px ;width:  300px !important;
                                                            background-size: cover;
                                                            background-repeat: no-repeat;
                                                            background-position: 50% 50%;
                                                            border-radius: 7px;
                                                            display: flex; " >
                                                        @else
                                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                                        @endif

                                                    </div>
                                                </a>

                                                <div class="block2-txt flex-w flex-t p-t-14" >
                                                    <div class="block2-txt-child1 flex-col-l ">
                                                        <span class="stext-105 cl7" style="text-align: start;">
                                                            <a class=" cl7 hov-cl1" href="{{ route('product.details', $product->slug) }}">
                                                                <h3 class="flex-t card-title trans-04 js-name-b2 p-b-6 card-title-name" >{{$product->name}}</h3>
                                                                <h4 class="flex-t card-title trans-04 js-name-b2 p-b-6 price_text"> {{trans('custom.price')}} : ${{$product->price}}</h4>
                                                            </a>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        @else
                            @isset($products)
                                @foreach ($products as $product)
                                    <div class="swiper-slide effect8">
                                        <div class=" isotope-item women" style="display: flex;">
                                            <div class="block2" >
                                                <a href="{{ route('product.details',$product->product->slug) }}">
                                                    <div class="block2-pic hov-img0  flex-w flex-c p-t-14">

                                                        @if($product->product->firstMedia)
                                                            <img src="{{ asset('images/products/'.$product->product->firstMedia->file_name) }}" alt="{{ $product->product->name }}" class="img-fluid w-100"
                                                                 style="max-width: 100%;  height: 254px ;width:  300px !important;
                                                            background-size: cover;
                                                            background-repeat: no-repeat;
                                                            background-position: 50% 50%;
                                                            border-radius: 7px;
                                                            display: flex; " >
                                                        @else
                                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->product->name }}" class="img-fluid w-100" >
                                                        @endif

                                                    </div>
                                                </a>

                                                <div class="block2-txt flex-w flex-t p-t-14" >
                                                    <div class="block2-txt-child1 flex-col-l ">
                                                        <span class="stext-105 cl7" style="text-align: start;">
                                                            <a class=" cl7 hov-cl1" href="{{ route('product.details', $product->product->slug) }}">
                                                                <h3 class="flex-t card-title trans-04 js-name-b2 p-b-6 card-title-name" >{{$product->product->name}}</h3>
                                                                <h4 class="flex-t card-title trans-04 js-name-b2 p-b-6 price_text"> {{trans('custom.price')}} : ${{$product->product->price}}</h4>
                                                            </a>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of products -->
    <!--get services -->
    <div class="customer-elctroinc customer-elctroinc-services tracking-order style-container display-n-m">
        <div class="container @if (app()->getLocale() == 'ar') container-ar @endif" style=" text-transform: uppercase;">
                <div class="best-seller-img">
                    <p class="@if (app()->getLocale() == 'ar') cat-ar @endif btn btn-3 hover-border-1 wobble-horizontal">
                        {{trans('custom.services')}}</p>
                </div>
            <div class="row" style="display: flex; flex-wrap: wrap;  align-items: flex-end; padding: 25px;
                          box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px;">

                <!-- tracking order-->

                        <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                            <div class="img-three shipping-div " >
                                <a href="{{ route('shipping') }}" >
                                    {{--   <p style="text-decoration: none;position: relative;top: 20px;font-size: 20px">{{trans('custom.shipping')}}</p> --}}
                                    <div class="img-three">
                                        <img src="{{ asset('website/imgs/Rectangle 6.png') }}" title="{{ trans('custom.shipping') }}"
                                            style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                            background-size: cover;
                            background-repeat: no-repeat;
                            background-position: 50% 50%;
                            margin-bottom: 5px;" >

                                        <p  class="service-p">{{ trans('custom.shipping') }} </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                            <div class="img-three shipping-div " >
                                <a href="{{ route('mediation') }}">
                                    @if($mediation)
                                        <img src="{{ asset('images/mediations/' . $mediation->image) }}" title="{{ trans('custom.mediation') }}"
                                                    style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    margin-bottom: 5px;" title="meditation">
                                            @else
                                                <img src="{{ asset('images/mediations/74366467144.jpg') }}" title="{{ trans('custom.mediation') }}"
                                                    style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    margin-bottom: 5px;" title="meditation">
                                            @endif

                                    <p  class=" service-p">{{ trans('custom.mediation') }}</p>

                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                            <div class="img-three shipping-div " >
                                    <a href="{{ route('translationServices') }}" >
                                        @if($translation)
                                            <div class="img-three">
                                                <img src="{{ asset('images/translations/' . $translation->image) }}" title="{{ trans('custom.translation_services') }}"
                                                    style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: 50% 50%;
                                    margin-bottom: 5px;" >
                                                @else
                                                    <img src="{{ asset('website/imgs/translation.jfif') }}" title="{{ trans('custom.translation_services') }}"
                                                        style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: 50% 50%;
                                    margin-bottom: 5px;" >
                                            </div>
                                        @endif
                                        <p   class="service-p">{{ trans('custom.translation_services') }}</p>

                                    </a>
                            </div>
                        </div>

                        @isset($services)
                            @foreach ($services as $service)
                                <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                                    <div class="img-three shipping-div " >
                                            <a href="#" >
                                                @if($service->firstMedia)
                                                    <div class="img-three">
                                                        <img  src="{{ asset('images/services/'.$service->firstMedia->file_name) }}" alt="{{ $service->name }}"
                                                            style=" border-radius: 7px;  height: 200px ; width: 100% !important;
                                                                    background-size: cover;
                                                                    background-repeat: no-repeat;
                                                                    background-position: 50% 50%;
                                                                    margin-bottom: 5px;" >
                                                        @else
                                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $service->name }}"
                                                                style=" border-radius: 7px;  height: 200px ; width: 100% !important;
                                                                background-size: cover;
                                                                background-repeat: no-repeat;
                                                                background-position: 50% 50%;
                                                                margin-bottom: 5px;" >
                                                    </div>
                                                @endif
                                                <p   class="service-p">{{ $service->name }}</p>
                                                <p>{!! $service->description !!}</p>
                                            </a>
                                    </div>
                                </div>
                            @endforeach
                        @endisset

                <!-- end of tracking order -->
            </div>
        </div>
    </div>
   </div>


    <div class="customer-elctroinc customer-elctroinc-services style-container display-n-d">
        <div class="container @if (app()->getLocale() == 'ar') container-ar @endif" style=" text-transform: uppercase;">
            <div class="best-seller-img">
                    <p class="@if (app()->getLocale() == 'ar') cat-ar @endif btn btn-3 hover-border-1 wobble-horizontal">
                        {{trans('custom.services')}}</p>
            </div>
                    <div class="gtco-testimonials">
                        <div class="owl-carousel owl-carousel1 owl-theme">

                            <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                                <div class="img-three shipping-div " >
                                    <a href="{{ route('shipping') }}" >
                                        {{--   <p style="text-decoration: none;position: relative;top: 20px;font-size: 20px">{{trans('custom.shipping')}}</p> --}}
                                        <div class="img-three">
                                            <img src="{{ asset('website/imgs/Rectangle 6.png') }}" title="{{ trans('custom.shipping') }}"
                                                style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                margin-bottom: 5px;" >

                                            <p   class="service-p">{{ trans('custom.shipping') }}

                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                                <div class="img-three shipping-div " >
                                    <a href="{{ route('mediation') }}">
                                        @if($mediation)
                                            <img src="{{ asset('images/mediations/' . $mediation->image) }}" title="{{ trans('custom.mediation') }}"
                                                        style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                                        background-size: cover;
                                                        background-repeat: no-repeat;
                                                        background-position: 50% 50%;
                                                        margin-bottom: 5px;" title="meditation">
                                                @else
                                                    <img src="{{ asset('images/mediations/74366467144.jpg') }}" title="{{ trans('custom.mediation') }}"
                                                        style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                                        background-size: cover;
                                                        background-repeat: no-repeat;
                                                        background-position: 50% 50%;
                                                        margin-bottom: 5px;" title="meditation">
                                                @endif

                                        <p  class=" service-p">{{ trans('custom.mediation') }}</p>

                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                                <div class="img-three shipping-div " >
                                        <a href="{{ route('translationServices') }}" >
                                            @if($translation)
                                                <div class="img-three">
                                                    <img src="{{ asset('images/translations/' . $translation->image) }}" title="{{ trans('custom.translation_services') }}"
                                                        style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        margin-bottom: 5px;" >
                                                    @else
                                                        <img src="{{ asset('website/imgs/translation.jfif') }}" title="{{ trans('custom.translation_services') }}"
                                                            style=" border-radius: 7px;  height: 170px ; width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        margin-bottom: 5px;" >
                                                </div>
                                            @endif
                                            <p   class="service-p">{{ trans('custom.translation_services') }}</p>

                                        </a>
                                </div>
                            </div>

                            @isset($services)
                            @foreach ($services as $service)
                                <div class="col-lg-3 col-md-3 col-12 wobble-horizontal left-div">
                                    <div class="img-three shipping-div " >
                                            <a href="#" >
                                                @if($service->firstMedia)
                                                    <div class="img-three">
                                                        <img  src="{{ asset('images/services/'.$service->firstMedia->file_name) }}" alt="{{ $service->name }}"
                                                            style=" border-radius: 7px;  height: 200px ; width: 100% !important;
                                                                    background-size: cover;
                                                                    background-repeat: no-repeat;
                                                                    background-position: 50% 50%;
                                                                    margin-bottom: 5px;" >
                                                        @else
                                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $service->name }}"
                                                                style=" border-radius: 7px;  height: 200px ; width: 100% !important;
                                                                background-size: cover;
                                                                background-repeat: no-repeat;
                                                                background-position: 50% 50%;
                                                                margin-bottom: 5px;" >
                                                    </div>
                                                @endif
                                                <p   class="service-p">{{ $service->name }}</p>
                                                <p>{!! $service->description !!}</p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset

                        </div>
                    </div>
        </div>
    </div>
</div>
@stop
