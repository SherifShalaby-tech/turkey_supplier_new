@extends('layouts.website.master')
@section('title', 'Home Page')
@section('css')
    <style>
        .card-title-name-home-cat {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

        }
    </style>
@endsection
@section('content')
    <!-- ADS -->
    <div class="bg0 p-t-10 p-b-10">

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 wobble-horizontal m-tb-10"
                    style="filter: drop-shadow(0px 10px 10px #909090);">
                    <div>
                        <a href="{{ route('membership') }}">

                            <img src="{{ asset('images/mediations/banner.jpg') }}" title="{{ trans('custom.membership') }}"
                                style="max-width: 100%;  height: 400px; width: 100% !important;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: 50% 50%;
                                    border-radius: 30px;
                                    border: 2px solid #2789a4;">
                        </a>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-12  m-tb-10" style="filter: drop-shadow(0px 10px 10px #909090);">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @isset($ads)
                                @foreach ($ads as $key => $ad)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        @if ($ad->image)
                                            <img class="d-block w-100 pop" src="{{ asset('images/ads/' . $ad->image) }}"
                                                alt="First slide"
                                                style="max-width: 100%;  height: 400px; width: 100% !important;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: 50% 50%;
                                                border-radius: 30px; ">
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
            </div>

            <div class="row p-tb-20">
                <div class="col-lg-3 col-md-3 col-12 m-tb-10">
                    <a href="{{ route('shipping') }}">
                        <div class="flex-center bg-s1 h-55">
                            <img class="p-r-l-10" src="{{ asset('website/imgs/shipping.png') }}" alt="">
                            <p class="cl2">{{ trans('custom.shipping') }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-12 m-tb-10">
                    <a href="{{ route('mediation') }}">
                        <div class="flex-center bg-s1 h-55">
                            <img class="p-r-l-10" src="{{ asset('website/imgs/mediation.png') }}" alt="">
                            <p class="cl2">{{ trans('custom.mediation') }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-12 m-tb-10">
                    <a href="{{ route('translationServices') }}">
                        <div class="flex-center bg-s1 h-55">
                            <img class="p-r-l-10" src="{{ asset('website/imgs/translation.png') }}" alt="">
                            <p class="cl2">{{ trans('custom.translation_services') }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-12 m-tb-10">

                    <a href="{{ route('category.products', 50) }}">
                        <div class="flex-center bg-s1 h-55">
                            <img class="p-r-l-10" src="{{ asset('website/imgs/real-states.png') }}" alt="">
                            <p class="cl2">{{ trans('custom.Real Estates') }}</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
    <!-- END ADS -->
    <!-- All category / supplier -->
    <section class="bg0 p-t-10  ">
        <div class="container-fluid">
            <div class="p-b-10 separator ">
                <div class="flex-center bg-s2 p-0">
                    <h3 class="ltext-102 cl1  p-r-l-10 p-10-40  r-m-text-s cursor-p" onclick="dCategorySuppliers(1)"
                        id="changeColorC">
                        {{ trans('custom.ALL_CATEGORY') }}
                    </h3>
                    <h3 class="ltext-102  p-r-l-10 p-10-40 bg1 cl0 r-m-text-s cursor-p" onclick="dCategorySuppliers(0)"
                        id="changeColorS">
                        {{ trans('custom.ALL_SUPPLIERS') }}
                    </h3>
                </div>
            </div>
            <div class="row hide" id="divCategory">
                <div class="col-sm-11 col-md-11 col-lg-11 col-12 txt-center row">

                    @foreach ($categories as $category)
                        <div class="col-sm-2 col-md-2 col-lg-2 p-b-10 col-6 isotope-item women">

                            <!-- Block2 -->
                            <div class="block2 ">
                                <div class="block2-pic hov-img0 ">
                                    <a href="{{ route('category.products', $category->id) }}">
                                        <img class="circle-img " src="{{ asset('images/categories/' . $category->image) }}"
                                            alt="IMG-PRODUCT" style="padding:20px; left:0%;">
                                    </a>
                                </div>

                                <div class="block2-txt  p-t-14">
                                    <div class=" flex-col-l txt-center">
                                        <a href="{{ route('category.products', $category->id) }}"
                                            class="stext-105 cl3 hov-cl1 trans-04 js-name-b2 p-b-6 card-title-name-home-cat height-text w-full">
                                            {{ $category->name }}
                                        </a>

                                        <span class="stext-104 cl4 txt-center w-full">
                                            {{ $category->subCategories->count() }} | {{ trans('custom.sub_categories') }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-sm-1 col-md-1 col-lg-1 col-12 p-b-10">
                    <a href="{{ route('categories.index') }}">
                        <div
                            class="bg1 p-tb-a-rl-20 b-r-r-20  flex-center stext-105 cl0 txt-center p-tb-10
                             @if (app()->getLocale() == 'ar') see-all-ar @endif">
                            <p> {{ trans('custom.see_all') }} +</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row" id="divSuppliers">
                <div class="col-sm-11 col-md-11 col-lg-11 col-12 txt-center row">
                    {{-- @if ($sellers->count() > 0) --}}
                        @forelse ($sellers as $seller)
                            <div class="col-sm-2 col-md-2 col-lg-2 p-b-10 col-6 isotope-item women">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <a href="{{ route('supplier.profile', $seller->id) }}"
                                            class="stext-105 cl3 hov-cl1 trans-04 js-name-b2 p-b-6 height-text w-full">
                                            @if ($seller->firstMedia)
                                                <img class="circle-img "
                                                    src="{{ asset('images/companies/' . $seller->firstMedia->file_name) }}"
                                                    alt="{{ $seller->name }}" style="padding:20px; left:0%;">
                                            @else
                                                <img class="circle-img " src="{{ asset('website/imgs/Group.png') }}"
                                                    alt="{{ $seller->name }}" style="padding:20px; left:0%;">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="block2-txt  p-t-14">
                                        <div class=" flex-col-l txt-center">
                                            <a href="{{ route('supplier.profile', $seller->id) }}"
                                                class="stext-105 cl3 hov-cl1 card-title-name-home-cat trans-04 js-name-b2 p-b-6 height-text w-full">
                                                {{ $seller->name }}
                                            </a>
                                            <span class="stext-104 cl4 txt-center w-full">
                                                @if ($seller->products->count() > 0)
                                                    {{ $seller->products->count() }} | {{ trans('custom.products') }}
                                                @else
                                                    0 | {{ trans('custom.products') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                        @endforelse
                    {{-- @endif --}}
                </div>

                <div class="col-sm-1 col-md-1 col-lg-1 col-12 p-b-10">
                    <a href="{{ route('getSellers') }}">
                        <div
                            class="bg1 p-tb-a-rl-20 b-r-r-20  flex-center stext-105 cl0 txt-center p-tb-10
                            @if (app()->getLocale() == 'ar') see-all-ar @endif">
                            <p> {{ trans('custom.see_all') }} + </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End All category / supplier -->
    <!-- trindeng product -->
    <section class="bg0   p-b-10">
        <div class="container-fluid">
            <div class="separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{ trans('custom.trending_product') }}
                    </h3>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 col-md-11 col-lg-11 p-b-10  row">
                    {{-- @isset($trending_product) --}}
                        @forelse ($trending_product as $product)
                            <div class="col-sm-2 col-md-3 col-lg-2 col-6 p-lr-10-md m-tb-5">
                                <div class="block2  bg-s3">
                                    <div class="block2-pic hov-img0">
                                        <a
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            <img src="{{ asset('images/products/' . $product->firstMedia->file_name) }}"
                                                alt="{{ $product->name }}" style="border-radius: 30px;     right: 0;">
                                        </a>
                                    </div>
                                    <div class="block2-txt">
                                        <div class="flex-col-l p-r-l-5">
                                            <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full  f-s-s">
                                                {{ $product->name }}
                                            </a>
                                            <span class="cl1 w-full p-r-l-10 p-tb-2 mtext-1075 f-s-s">
                                                {{ $code }} {{ $product->price }}
                                            </span>
                                        </div>

                                        <div class=" p-lr-0-md ">
                                            <div class="flex-product">
                                                <form action="{{ route('carts.add.product') }}" method="POST">
                                                    @csrf
                                                    @if (auth('company')->user())
                                                        <input type="hidden" name="user_id"
                                                            value="{{ auth('company')->user()->id }}">
                                                    @endif
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button
                                                        class="cl0 bg1 p-tb-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s hover-shadow"
                                                        type="submit">
                                                        {{ trans('custom.add_to_cart') }} <i
                                                            class="fas fa-shopping-cart"></i></button>
                                                </form>

                                                <button
                                                    class="cl0 bg2 p-tb-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s hover-shadow  addToFavourte {{ $product->IsFavourite ? 'cl1' : '' }}"
                                                    data-productid="{{ $product->id }}"
                                                    data-companyid="{{ auth('company')->user() ? auth('company')->user()->id : '' }}">
                                                    <i class="fa-solid fa-heart" style="pointer-events:none;"></i>
                                                </button>
                                            </div>

                                            {{-- <div class="flex-product">
                                                <a class="cont-sup w-full" href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug.'#get_form']) }}">
                                                    <button class="w-full cl0 bg1 p-tb-5  m-t-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s">
                                                        {{trans('custom.contact_supplier' )}}
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </button>
                                                </a>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    {{-- @endisset --}}
                </div>
                <div class="col-sm-1 col-md-1 col-lg-1 col-12 p-b-10">
                    <a href="{{ route('getTrendingProducts') }}">
                        <div
                            class="bg1 p-tb-a-rl-20 b-r-r-20  flex-center stext-105 cl0 txt-center p-tb-10
                                    @if (app()->getLocale() == 'ar') see-all-ar @endif">
                            <p> {{ trans('custom.see_all') }} + </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End trindding product -->
    <!-- you may like product -->
    <section class="bg0 p-b-10">
        <div class="container-fluid">
            <div class="separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{ trans('custom.you_may_like') }}
                    </h3>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 col-md-11 col-lg-11 p-b-10 row">
                    @if (!auth('company')->user())
                        {{-- @isset($trending_product) --}}
                        @forelse ($trending_product as $product)
                            <div class="col-sm-2 col-md-3 col-lg-2 col-6 p-lr-10-md m-tb-5">
                                <div class="block2  bg-s3">
                                    <div class="block2-pic hov-img0">
                                        <a
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            @if ($product->firstMedia)
                                                <img src="{{ asset('images/products/' . $product->firstMedia->file_name) }}"
                                                    alt="{{ $product->name }}" style="border-radius: 30px;    right: 0;">
                                            @else
                                                <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}"
                                                    style="  border-radius: 30px;    right: 0;">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="block2-txt">
                                        <div class="flex-col-l p-r-l-5">
                                            <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full  f-s-s">
                                                {{ $product->name }}
                                            </a>

                                            <span class="cl1 w-full p-r-l-10 p-tb-2 mtext-1075 f-s-s">
                                                {{ $code }} {{ $product->price }}
                                            </span>
                                        </div>


                                        <div class=" p-lr-0-md ">
                                            <div class="flex-product">
                                                <form action="{{ route('carts.add.product') }}" method="POST">
                                                    @csrf
                                                    @if (auth('company')->user())
                                                        <input type="hidden" name="user_id"
                                                            value="{{ auth('company')->user()->id }}">
                                                    @endif
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button
                                                        class="cl0 bg1 p-tb-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s hover-shadow"
                                                        type="submit">
                                                        {{ trans('custom.add_to_cart') }} <i
                                                            class="fas fa-shopping-cart"></i></button>
                                                </form>

                                                <button
                                                    class="cl0 bg2 p-tb-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s hover-shadow  addToFavourte {{ $product->IsFavourite ? 'cl1' : '' }}"
                                                    data-productid="{{ $product->id }}"
                                                    data-companyid="{{ auth('company')->user() ? auth('company')->user()->id : '' }}">
                                                    <i class="fa-solid fa-heart" style="pointer-events:none;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        {{-- <div class="flex-product">
                                            <a class="cont-sup w-full" href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug.'#get_form']) }}">
                                                <button class="w-full cl0 bg1 p-tb-5  m-t-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s">
                                                    {{trans('custom.contact_supplier' )}}
                                                    <i class="fa-solid fa-envelope"></i>
                                                </button>
                                            </a>

                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        {{-- @endisset --}}
                    @else
                        {{-- @isset($products) --}}
                            @forelse ($products as $product)
                                <div class="col-sm-2 col-md-3 col-lg-2 col-6 p-lr-10-md m-tb-10">
                                    <div class="block2  bg-s3">
                                        <div class="block2-pic hov-img0">
                                            <a
                                                href="{{ route('product.details', ['id' => $product->product->id, 'slug' => $product->product->slug]) }}">
                                                @if ($product->product->firstMedia)
                                                    <img src="{{ asset('images/products/' . $product->product->firstMedia->file_name) }}"
                                                        alt="{{ $product->product->name }}"
                                                        style=" border-radius: 30px;    right: 0;">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}"
                                                        alt="{{ $product->product->name }}"
                                                        style="border-radius: 30px;    right: 0;">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="block2-txt ">
                                            <div class="flex-col-l p-r-l-5">
                                                <a href="{{ route('product.details', ['id' => $product->product->id, 'slug' => $product->product->slug]) }}"
                                                    class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full  f-s-s">
                                                    {{ $product->product->name }}
                                                </a>

                                                <span class="cl1 w-full p-r-l-10 p-tb-2 mtext-1075 f-s-s">
                                                    {{ $code }} {{ $product->product->price }}
                                                </span>
                                            </div>
                                            <div class=" p-lr-0-md ">
                                                <div class="flex-product">
                                                    <div class="flex-product">
                                                        <form action="{{ route('carts.add.product') }}" method="POST">
                                                            @csrf
                                                            @if (auth('company')->user())
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth('company')->user()->id }}">
                                                            @endif
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            <button
                                                                class="cl0 bg1 p-tb-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s hover-shadow"
                                                                type="submit">
                                                                {{ trans('custom.add_to_cart') }} <i
                                                                    class="fas fa-shopping-cart"></i></button>
                                                        </form>

                                                        <button
                                                            class="cl0 bg2 p-tb-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s hover-shadow  addToFavourte {{ $product->IsFavourite ? 'cl1' : '' }}"
                                                            data-productid="{{ $product->id }}"
                                                            data-companyid="{{ auth('company')->user() ? auth('company')->user()->id : '' }}">
                                                            <i class="fa-solid fa-heart" style="pointer-events:none;"></i>
                                                        </button>
                                                    </div>

                                                </div>

                                                {{-- <div class="flex-product">
                                                <a class="cont-sup w-full" href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug.'#get_form']) }}">
                                                    <button class="w-full cl0 bg1 p-tb-5  m-t-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s">
                                                        {{trans('custom.contact_supplier' )}}
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </button>
                                                </a>
                                            </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        {{-- @endisset --}}
                    @endif
                </div>

                <div class="col-sm-1 col-md-1 col-lg-1 col-12 p-b-10">
                    <a href="{{ route('getProductsYouMayLike') }}">
                        <div
                            class="bg1 p-tb-a-rl-20 b-r-r-20  flex-center stext-105 cl0 txt-center p-tb-10
                            @if (app()->getLocale() == 'ar') see-all-ar @endif">
                            <p> {{ trans('custom.see_all') }} + </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End you may like  product -->
    <!-- services product -->
    <section class="bg0 p-t-10 p-b-20">

        <div class="container-fluid">
            <div class="p-b-10 separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{ trans('custom.services') }}
                    </h3>
                </div>
            </div>

            <div class="row p-b-0 flex-c-m ">
                <div class="col-12 col-md-12 col-lg-12 p-b-20 ">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-20 m-tb-10">
                            <div class="block2  bg-s3">
                                <div class="block2-pic hov-img0">
                                    <a href="{{ route('shipping') }}">
                                        <img src="{{ asset('website/imgs/Rectangle 6.png') }}"
                                            title="{{ trans('custom.shipping') }}"
                                            style="
                                                            border-radius: 30px;
                                                            padding: 10px 10px;    right: 0;">
                                    </a>
                                </div>

                                <div class="block2-txt  p-t-14">
                                    <div class=" flex-col-l p-r-l-10">
                                        <a href="{{ route('shipping') }}"
                                            class=" p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full">
                                            {{ trans('custom.shipping') }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 col-6  p-lr-20  m-tb-10">
                            <div class="block2  bg-s3">
                                <div class="block2-pic hov-img0">
                                    <a href="{{ route('mediation') }}">
                                        @if ($mediation)
                                            <img src="{{ asset('images/mediations/' . $mediation->image) }}"
                                                title="{{ trans('custom.mediation') }}"
                                                style=" border-radius: 30px;
                                                            padding: 10px 10px;    right: 0;">
                                        @else
                                            <img src="{{ asset('images/mediations/74366467144.jpg') }}"
                                                title="{{ trans('custom.mediation') }}"
                                                style=" border-radius: 30px;
                                                        padding: 10px 10px;    right: 0;">
                                        @endif
                                    </a>
                                </div>

                                <div class="block2-txt  p-t-14">
                                    <div class=" flex-col-l p-r-l-10">
                                        <a href="{{ route('mediation') }}"
                                            class=" p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full">
                                            {{ trans('custom.mediation') }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 col-6  p-lr-20 m-tb-10">
                            <div class="block2  bg-s3">
                                <div class="block2-pic hov-img0">
                                    <a href="{{ route('translationServices') }}">
                                        @if ($translation)
                                            <img src="{{ asset('images/translations/' . $translation->image) }}"
                                                title="{{ trans('custom.translation_services') }}"
                                                style="border-radius: 30px;
                                                            padding: 10px 10px;    right: 0;">
                                        @else
                                            <img src="{{ asset('website/imgs/translation.jfif') }}"
                                                title="{{ trans('custom.translation_services') }}"
                                                style="border-radius: 30px;
                                                        padding: 10px 10px;    right: 0;">
                                        @endif
                                    </a>
                                </div>

                                <div class="block2-txt  p-t-14">
                                    <div class=" flex-col-l p-r-l-10">
                                        <a href="{{ route('translationServices') }}"
                                            class=" p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full">
                                            {{ trans('custom.translation_services') }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 col-6  p-lr-20  m-tb-10">
                            <div class="block2  bg-s3">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                        </li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        {{-- @if ($real_products->count() > 0) --}}
                                            @forelse ($real_products as $key => $product)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <div class="block2-pic hov-img0">
                                                        @if ($product->firstMedia)
                                                            <a
                                                                href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                                <img src="{{ asset('images/products/' . $product->firstMedia->file_name) }}"
                                                                    title="{{ trans('custom.Real Estates') }}"
                                                                    style="border-radius: 30px;
                                                                padding: 10px 10px;    right: 0;">
                                                            </a>
                                                        @else
                                                            <img src="{{ asset('images/no-image.png') }}"
                                                                alt="{{ $product->name }}"
                                                                style=" border-radius: 30px;
                                                            padding: 10px 10px;    right: 0;">
                                                        @endif
                                                    </div>

                                                    <div class="block2-txt  p-t-14">
                                                        <div class=" flex-col-l p-r-l-10">
                                                            <a href="{{ route('translationServices') }}"
                                                                class=" p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full">
                                                                {{ trans('custom.Real Estates') }}
                                                            </a>

                                                        </div>
                                                    </div>

                                                </div>
                                            @empty
                                            @endforelse
                                        {{-- @endif --}}
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @isset($services)
                            @foreach ($services as $service)
                                <div class="col-sm-3 col-md-3 col-lg-3 col-6  p-lr-20  m-tb-10">
                                    <div class="block2  bg-s3">
                                        <div class="block2-pic hov-img0">
                                            <a href="#">
                                                @if ($service->firstMedia)
                                                    <img src="{{ asset('images/services/' . $service->firstMedia->file_name) }}"
                                                        alt="{{ $service->name }}"
                                                        style="border-radius: 30px;
                                                                padding: 10px 10px;    right: 0;">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}"
                                                        alt="{{ $service->name }}"
                                                        style=" border-radius: 30px;
                                                            padding: 10px 10px;    right: 0;">
                                                @endif
                                            </a>
                                        </div>

                                        <div class="block2-txt  p-t-14">
                                            <div class=" flex-col-l p-r-l-10">
                                                <a href="#"
                                                    class=" p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full">
                                                    {{ $service->name }}
                                                </a>
                                                <span class="cl2 w-full p-r-l-10 p-tb-20 mtext-1075">
                                                    {!! $service->description !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End services product -->
@endsection
@section('js')
    <script>
        function dCategorySuppliers(is_category) {
            var colorC = document.getElementById("changeColorC");
            var colorS = document.getElementById("changeColorS");
            var dCategory = document.getElementById("divCategory");
            var dSuppliers = document.getElementById("divSuppliers");

            if (is_category === 1) {
                dCategory.classList.remove("hide");
                dSuppliers.classList.add("hide");
                colorC.classList.add("bg1");
                colorC.classList.add("cl0");
                colorC.classList.remove("cl1");
                colorS.classList.remove("bg1");
                colorS.classList.remove("cl0");
                colorS.classList.add("cl1");

            } else {

                dSuppliers.classList.remove("hide");
                dCategory.classList.add("hide");

                colorC.classList.remove("bg1");
                colorC.classList.remove("cl0");
                colorC.classList.add("cl1");
                colorS.classList.add("bg1");
                colorS.classList.add("cl0");
                colorS.classList.remove("cl1");
            }
        }
    </script>
@endsection
