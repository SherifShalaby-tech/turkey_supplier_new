@extends('layouts.website.master')
@section('title',$product->name)
@section('content')
<style>
    #thumbs .owl-prev{
        position: relative;
        top: -60px;
        right: 4%;
    }

    #thumbs .owl-next{
        position: relative;
        top: -60px;
        left: 100%;
    }


</style>
<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.products')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-23 p-b-140 m-lr-15">
    <div class="container-fluid">

        <div class="row p-r-0-md p-l-0-md ">
            <div class="col-sm-6 col-md-6 col-lg-6 col-12 p-b-35 isotope-item   p-lr-40 p-r-0-md p-l-0-md">
                <!-- Block2 -->
                <div class="block2">
                    <div id="slider" class="owl-carousel product-details-slider ">
                        @if($product->media()->count() > 0)
                            @foreach($product->media as $media)
                            <div class="item  product-image block-s-1  @if (app()->getLocale() == 'ar') product-image-ar @endif"
                             style=" @if (app()->getLocale() == 'ar')
                            position: relative;
                            z-index: 90000;
                            height: auto;
                            @endif">
                                    <img class="image "
                                        src="{{ asset('images/products/'. $media->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                            style="
                                            border-radius: 10px;transition: transform 0.8s ease-out;" >
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div id="thumbs" class="owl-carousel product-details-thumb m-t-20">
                        @if($product->media()->count() > 0)
                            @foreach($product->media as $media)
                                <div class="thumb block-s-1">
                                    <img class="" src="{{ asset('images/products/' . $media->file_name) }}" alt="{{ $product->name }}" class=" img-fluid w-100"
                                          style="border-radius: 4px;padding: 12px; ">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12 p-b-35 isotope-item   p-lr-5 p-r-0-md p-l-0-md"  >
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class=" flex-col-l ">


                            <span class="mtext-105 cl1 flex-w m-b-10">
                                <p class="p-r-10" >
                                    <a class="cl1" href="{{route('supplier.profile',$product->company->id)}}">{{$product->company->name}}</a>
                                </p> <span class="cl2"> | </span>
                                <p class="p-lr-10">  {{$product->code}} </p>

                                    {{-- <form action="{{route('fav.add')}}" method="POST">

                                        @csrf
                                        @if(auth('company')->user())
                                            <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
                                        @endif
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <button class="three btn btn-contact btn-chat hover-shadow bg2 f-s-s  {{$product->is_like ? 'cl1':'cl0'}}">
                                        <i class="fa-solid fa-heart"></i></button>
                                    </form> --}}
                                    <button  class="three btn btn-contact btn-chat hover-shadow cl0 bg2 f-s-s addToFavourte {{$product->isFavourite ? 'cl1':''}}" data-productid="{{$product->id}}" data-companyid="{{auth('company')->user()?auth('company')->user()->id:''}}">
                                        <i class="fa-solid fa-heart" style="pointer-events:none;"></i></button>
                                    @if (isset($product->video_description))
                                        <a target="_blank" href="{{$product->video_description}}" style="margin-left: 10px" ><i class="fa-solid fa-video fa-lg" style="color: #acdee5"></i></a>
                                    @endif


                            </span>

                            <span class="ltext-109 cl2  m-b-10">
                                <p>   {!! $product->name !!}</p>
                            </span>

                            <span class="stext-105 cl2 m-b-20">
                                <p ><i class="fa-solid fa-eye"></i> : <span style="margin-left: 10px">{{$product->views}}</span></p>
                            </span>

                            <span class="mtext-114 cl1  m-b-10">
                                <p>{{$code}}  {{$product->price}}</p>
                            </span>

                            <span class="stext-105 cl2  m-b-10">
                                <div class="product-rate">
                                    @foreach($product->rating as $rate)
                                        <span class="fa fa-star checked"></span>
                                    @endforeach
                                </div>
                            </span>

                            <span class="mtext-110 cl3  m-b-25">
                                @if($product->description)
                                    <p>  {!! $product->description !!} </p>
                                @endif
                            </span>

                            <span  class="mtext-107  cl2 flex-c m-b-20" >
                                <div class="swatch clearfix" data-option-index="0">
                                    <div class="header cl2 mtext-110 ">{{trans('custom.size')}}</div>
                                    @if($product->sizes)
                                    <div class="row">
                                        @foreach($product->sizes as $size)
                                            <div data-value="{{$size->sizeName}}" class="m-lr-5 swatch-element plain {{$size->sizeName}} available">
                                                <label for="swatch-0-m cl3" class="border-size p-lr-7">
                                                    {{$size->sizeName}}

                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <div class="swatch clearfix p-lr-40" data-option-index="1">
                                    <div class="header cl2 mtext-110 ">{{trans('custom.color')}}</div>
                                    @if($product->colors)
                                    <div class="row">
                                        @foreach($product->colors as $color)
                                            <div data-value="{{$color->colorName}}" class="m-lr-5 swatch-element color {{$color->colorName}} available">
                                                <label class="cl3 border-color-name p-lr-7 m-b-0" for="swatch-1-{{$color->colorName}}" >
                                                    {{$color->colorName}}
                                                </label>
                                                <label class="cl3 border-color-code p-lr-7" for="swatch-1-{{$color->colorCode}}" >
                                                    {{$color->colorCode}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </span>

                            <span class="mtext-107  cl0  flex-c-str row">
                                <form  action="{{route('carts.add.product')}}" method="POST">
                                    @csrf
                                    @if(auth('company')->user())
                                        <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                    @endif
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button class="cl2 bg2 p-tb-12 p-lr-50 m-lr-20 m-lr-0-md m-tb-10 mtext-107 btn btn-cart  hover-shadow">{{trans('custom.add_to_cart')}}
                                        <i class="fa-solid fa-cart-shopping"></i> </button>
                                </form>
                                <form   action="{{route('carts.add.product')}}" method="POST">
                                    @csrf
                                    @if(auth('company')->user())
                                        <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                    @endif
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button type="submit"  class=" cl0 bg1 p-tb-12 p-lr-50 m-lr-20 m-lr-0-md m-tb-10 mtext-107 btn btn-cart  hover-shadow">{{trans('custom.buy_now')}}
                                        <i class="fa-solid fa-circle-dollar-to-slot"></i></button>
                                </form>

                                <span>
                                    <a class="cont-sup " href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug.'#get_form']) }}">
                                        <button class="cl2 bg2 p-tb-12 p-lr-50 m-lr-20 m-lr-0-md m-tb-10 mtext-107 btn btn-cart  hover-shadow">{{trans('custom.contact_supplier')}}
                                            <i class="fa-solid fa-envelope"></i></button>
                                    </a>
                                </span>

                            </span>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if($product->certificates->count() > 0)
            <div class="p-b-10 p-t-10 separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{trans('products.certificates')}}
                    </h3>
                </div>
            </div>
        @endif
        <div class="row isotope-grid">
            <div class="col-sm-12 col-md-12 col-lg-12 col-12 p-b-35 isotope-item women">
                @if($product->certificates->count() > 0)

                    <div class="card-body my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                        <div class="grid-hover row">
                            @forelse ( $product->certificates as $media)
                                <div class="col-lg-2 col-6">
                                        <figure class="effect-lily">
                                                <img src="{{ asset('images/products/certificates/' . $media->image) }}" alt="img12"
                                                style="
                                                max-width: 100%;  height: 143px;width: 100% !important;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: 50% 50%;
                                                border-radius: 4px;"/>
                                        <figcaption>
                                            <div>

                                            </div>

                                        </figcaption>
                                    </figure>
                                </div>
                            @empty
                                <div class="alert alert-danger">{{trans('product.certificates_not_found')}}</div>
                            @endforelse
                        </div>
                    </div>
                @endif
            </div>
        </div>


            <div class="p-b-10 separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.product_details')}}
                    </h3>
                </div>
			</div>

        <div class="row ">
            <div class="col-sm-9 col-md-9 col-lg-9 col-12 p-b-35 isotope-item women p-lr-100 p-r-0-md p-l-0-md ">

                <span class="mtext-107 cl3">
                    @if($product->Place_Origin)
                        <p>
                            <a class="cl2 mtext-109">{{trans('custom.place_origin')}} : </a>
                            <span style="margin-left: 10px">{{$product->Place_Origin ?? '-'}}</span>
                        </p>
                    @endif
                </span>

                <span class="mtext-107 cl3">
                    @if($product->Supply_Ability)
                        <p>
                            <a class="cl2 mtext-109" >{{trans('custom.Supply_Ability')}} :</a>
                            <span style="margin-left: 10px">{{$product->Supply_Ability ?? '-'}}</span>
                        </p>
                    @endif
                </span>
                <span class="mtext-107 cl3">
                    @if($product->Packaging)
                        <p>
                            <a class="cl2 mtext-109">{{ trans('product.Packaging') }} : </a>
                            <span style="margin-left: 10px">{{$product->Packaging ?? '-'}}</span>
                        </p>
                    @endif
                </span>

            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 col-12 p-b-35 isotope-item women">
                <span class="stext-105 cl3">
                    <form action="{{route('carts.add.product')}}" method="POST">
                        @csrf
                        @if(auth('company')->user())
                            <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                        @endif
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit" class="bg2 cl2 p-tb-12 p-lr-70 m-lr-30 mtext-107  btn btn-contact
                         @if (app()->getLocale() == 'tr') btn-contact-tr @endif">{{trans('custom.get_a_sample')}}
                         <i class="fa-solid fa-cubes"></i></button>
                    </form>
                </span>
            </div>
        </div>

            <div class="p-b-10 separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.qty')}} / {{trans('custom.lead_time_days')}}
                    </h3>
                </div>
            </div>

        <div class="row isotope-grid">
            <div class="col-sm-12 col-md-12 col-lg-12 col-12 p-b-35 isotope-item women p-lr-100 p-r-0-md p-l-0-md ">
                <table class="table borcolortable">
                    <tbody>
                    <tr class="borcolortable ">
                        <th class="borcolortable">{{trans('custom.qty')}}</th>
                        @foreach ( $product->leadtimes as $leadtime )
                            <td class="borcolortable">{{$leadtime->qty}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="borcolortable">{{trans('custom.lead_time_days')}}</th>
                        @foreach ($product->leadtimes as $leadtime)
                            <td class="borcolortable">{{$leadtime->days}}</td>
                        @endforeach

                    </tr>
                    <tr>
                        <th class="borcolortable">{{trans('custom.price')}}</th>
                        @foreach ($product->leadtimes as $leadtime)
                            <td class="borcolortable">{{$code}} {{$leadtime->price}}</td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

            <div class="p-b-10 separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.You_may_also_like')}}
                    </h3>
                </div>
            </div>

            <div class="row isotope-grid">
                <div class="col-12 col-md-12 col-lg-12 p-b-35 isotope-item women  p-lr-70  p-r-0-md p-l-0-md ">
                    <div class="row">
                        @if($related_product->count() > 0)
                            @foreach($related_product as $product_r)
                            <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-20 p-lr-10-md m-b-20">
                                    <div class="block2  bg-s2 " style="">
                                        <div class="block2-pic hov-img0">
                                            <a href="{{route('product.details',['id' => $product_r->id, 'slug' => $product_r->slug])}}">
                                                @if($product->firstMedia)
                                                    <img src="{{ asset('images/products/'.$product_r->firstMedia->file_name) }}" alt="{{ $product_r->name }}"
                                                        style="
                                                                border-radius: 30px;
                                                                padding: 7px 10px;right:0;">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" alt="{{ $product_r->name }}"
                                                    style="
                                                            border-radius: 30px;
                                                            padding: 7px 10px;right:0;">
                                                @endif
                                            </a>

                                        </div>

                                        <div class="block2-txt">
                                            <div class="flex-col-l p-r-l-5">
                                                <a href="{{route('product.details',['id' => $product_r->id, 'slug' => $product_r->slug])}}"
                                                    class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full  f-s-s">
                                                    {{$product_r->name}}
                                                </a>

                                                <span class="cl1 w-full p-r-l-10 p-tb-2 mtext-1075 f-s-s">
                                                    {{$code}}{{$product_r->price}}
                                                </span>
                                            </div>


                                            <div class=" p-lr-0-md ">
                                                <div class="flex-product">
                                                    <form  action="{{route('carts.add.product')}}" method="POST">
                                                        @csrf
                                                        @if(auth('company')->user())
                                                            <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                                        @endif
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <button class="btn btn-cart hover-shadow cl0 bg1 f-s-s" type="submit">
                                                            {{trans('custom.add_to_cart')}} <i class="fas fa-shopping-cart"></i></button>
                                                    </form>

                                                    {{-- <form action="{{route('fav.add')}}" method="POST">
                                                        @csrf
                                                        @if(auth('company')->user())
                                                            <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
                                                        @endif
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <button class="three btn btn-contact btn-chat hover-shadow bg2 f-s-s  {{$product->is_like ? 'cl1':'cl0'}}">
                                                        <i class="fa-solid fa-heart"></i></button>
                                                    </form> --}}
                                                    <button  class="three btn btn-contact btn-chat hover-shadow cl0 bg2 f-s-s addToFavourte {{$product_r->isFavourite? 'cl1':''}}" data-productid="{{$product->id}}" data-companyid="{{auth('company')->user()?auth('company')->user()->id:''}}">
                                                        <i class="fa-solid fa-heart" style="pointer-events:none;"></i></button>

                                                </div>

                                          {{--  <div class="flex-product">
                                                <a class="cont-sup " href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug.'#get_form']) }}">
                                                    <button class=" cl0 bg1 p-tb-5  m-t-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s">
                                                        {{trans('custom.contact_supplier' )}}
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </button>
                                                </a>
                                            </div> --}}
                                                {{--<div class="txt-center">
                                                    <a class="cont-sup " href="{{ route('product.details', $product->slug.'#get_form') }}">
                                                        <button class=" cl0 bg1 p-tb-5 p-lr-40  m-t-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s">
                                                            {{trans('custom.contact_supplier' )}}
                                                            <i class="fa-solid fa-envelope"></i>
                                                        </button>
                                                    </a>
                                                </div> --}}

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="add-address" style="margin-bottom: 135px">
                                <p class="text-danger alert alert-danger">There are no search results !
                                </p>
                            </div>
                        @endif
                        {{$related_product->onEachSide(0)->links()}}
                    </div>
                </div>

            </div>


                <div class="p-b-10 separator-f">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.supplier_details')}}
                        </h3>
                    </div>
                </div>


            <div class="row  ">
                <div class="col-sm-9 col-md-9 col-lg-9 col-12 p-b-10 isotope-item  ">

                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-12 p-b-10 isotope-item  ">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-12 p-b-35">
                        <span class="stext-105 cl3">
                            <a class="cont-sup " href="#get_form">
                                <button class="btn bg2 cl2 p-tb-12 p-lr-70 m-lr-30 mtext-107">{{trans('custom.contact_supplier')}}
                                    <i class="fa-solid fa-envelope"></i></button>
                            </a>
                        </span>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-12 p-b-35 n">
                        <span class="stext-105 cl3">
                            <a href="https://api.whatsapp.com/send?phone={{$product->company->phone}}">
                                <button class="btn bg2 cl2 p-tb-12 p-lr-70 m-lr-30 mtext-107">{{trans('custom.chat_now')}}
                                    <i class="fa-solid fa-comments"></i></button>
                            </a>
                        </span>
                    </div>
                </div>
            </div>


            <div class="p-b-10 separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.Recommended_by_seller')}}
                    </h3>
                </div>
            </div>

        <div class="row isotope-grid">
            <div class="col-12 col-md-12 col-lg-12 p-b-35 isotope-item women  p-lr-70  p-r-0-md p-l-0-md ">
                <div class="row">
                    @if($Other_products->count() > 0)
                        @foreach($Other_products as $product_o)
                            <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-20 p-lr-10-md m-b-20">
                                <div class="block2  bg-s2">
                                    <div class="block2-pic hov-img0">
                                        <a href="{{ route('product.details',['id' => $product_o->id, 'slug' => $product_o->slug]) }}">
                                            @if($product_o->firstMedia)
                                                <img  src="{{ asset('images/products/'.$product_o->firstMedia->file_name) }}" alt="{{ $product_o->name }}"
                                                    style="
                                                            border-radius: 30px;
                                                            padding: 7px 10px;right:0;">
                                            @else
                                                <img  src="{{ asset('images/no-image.png') }}" alt="{{ $product_o->name }}"
                                                style="
                                                        border-radius: 30px;
                                                        padding: 7px 10px;right:0;">
                                            @endif
                                        </a>

                                    </div>

                                    <div class="block2-txt ">
                                        <div class="flex-col-l p-r-l-5">
                                            <a href="{{route('product.details',['id' => $product_o->id, 'slug' => $product_o->slug])}}"
                                                class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full  f-s-s">
                                                {{$product_o->name}}
                                            </a>

                                            <span class="cl1 w-full p-r-l-10 p-tb-2 mtext-1075 f-s-s">
                                                {{$code}} {{$product_o->price}}
                                            </span>
                                        </div>


                                        <div class=" p-lr-0-md ">
                                            <div class="flex-product">
                                                <form  action="{{route('carts.add.product')}}" method="POST">
                                                    @csrf
                                                    @if(auth('company')->user())
                                                        <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                                    @endif
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <button class="btn btn-cart hover-shadow cl0 bg1 f-s-s" type="submit">
                                                        {{trans('custom.add_to_cart')}} <i class="fas fa-shopping-cart"></i></button>
                                                </form>

                                                {{-- <form action="{{route('fav.add')}}" method="POST">
                                                    @csrf
                                                    @if(auth('company')->user())
                                                        <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
                                                    @endif
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <button class="three btn btn-contact btn-chat hover-shadow  bg2 f-s-s  {{$product->is_like ? 'cl1':'cl0'}}">
                                                    <i class="fa-solid fa-heart"></i></button>
                                                </form> --}}

                                                <button  class="three btn btn-contact btn-chat hover-shadow cl0 bg2 f-s-s addToFavourte {{$product_o->isFavourite ? 'cl1':''}}" data-productid="{{$product->id}}" data-companyid="{{auth('company')->user()?auth('company')->user()->id:''}}">
                                                    <i class="fa-solid fa-heart" style="pointer-events:none;"></i></button>

                                            </div>

                                          {{-- <div class="flex-product">
                                                <a class="cont-sup " href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug.'#get_form']) }}">
                                                    <button class=" cl0 bg1 p-tb-5  m-t-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s">
                                                        {{trans('custom.contact_supplier' )}}
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </button>
                                                </a>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="add-address" style="margin-bottom: 135px">
                            <p class="text-danger alert alert-danger">There are no search results !
                            </p>
                        </div>
                    @endif
                    {{$Other_products->onEachSide(0)->links()}}
                </div>
            </div>
        </div>


            <div class="p-b-10 separator-f">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.Send_your_message_to_this_supplier')}}
                    </h3>
                </div>
            </div>
        @if(Auth::guard('company')->user() && Auth::guard('company')->user()->trade_role == 'buyer')


            <div class="row isotope-grid">
                <div class="col-12 col-md-12 col-lg-12 p-b-35 isotope-item women  p-lr-70  p-r-0-md p-l-0-md ">

                    <form id="get_form" action="{{route('contact_supplier')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($product->company)
                            <input type="hidden" name="supplier_id" value="{{$product->company->id}}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                        @endif
                        @if(auth('company')->user())
                            <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                        @endif
                        <div class="form-group flex-w">
                            <label>{{trans('custom.to')}}:</label>
                            @if($product->company)
                                <span>{{$product->company->name}}</span>
                            @endif
                        </div>
                        <div class="form-group">

                            {{-- @if(auth('company')->user()) --}}
                            <input  value="{{auth('company')->user()->name}}" type="text" class="form-control  bg-input1" name="name"  disabled placeholder="{{trans('custom.name')}}">
                            {{-- @else
                            <input  type="text" class="form-control" name="name" style="width: 50%" >
                            @endif --}}
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            {{-- @if(auth('company')->user()) --}}
                            <input value="{{auth('company')->user()->email}}" type="email" class="form-control bg-input1" name="email"  disabled placeholder="{{trans('custom.email')}}">
                            {{-- @else
                                <input  type="email" class="form-control" name="email" style="width: 50%" >
                            @endif --}}
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <input value="{{old('address')}}" type="text" class="form-control bg-input1" name="address" placeholder="{{trans('custom.address')}}" >
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <input value="{{old('subject')}}" type="text" class="form-control bg-input1" name="subject" placeholder="{{trans('custom.subject')}}" >
                            @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <textarea required="required" rows="4" cols="50" name="message"
                                      placeholder="Enter your inquiry details such as product name, color, size, MOQ, FOB, etc." class="form-control bg-input1"
                                      style="resize: none"></textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- files -->
                        <div class="form-group col-lg-4 col-12">
                            <label>{{trans('custom.file')}}</label>

                            <p class="text-danger">* {{trans('custom.attachment_format')}} pdf, jpeg ,.jpg , png </p>
                            <input type="file" class="form-control bg-input1" name="file" >

                        </div>
                        <!-- end file -->
                        <div class="form-group">
                            <input type="submit" class="btn bg1 cl0 p-lr-50" value="{{trans('custom.send')}}">
                        </div>
                    </form>
                </div>
            </div>
        @elseif (Auth::guard('admin')->user() )

        @elseif (Auth::guard('company')->user())

        @elseif(!Auth::user())
            <div class="row isotope-grid">
                <div class="col-12 col-md-12 col-lg-12 p-b-35 isotope-item women  p-lr-70  p-r-0-md p-l-0-md ">

                    <form id="get_form" action="{{route('visitorContactSupplier')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($product->company)
                            <input type="hidden" name="supplier_id" value="{{$product->company->id}}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                        @endif
                        <div class="form-group">
                            <label>{{trans('custom.to')}}:</label>
                            @if($product->company)
                                <span>{{$product->company->name}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('custom.name')}}</label>
                            <input  type="text" class="form-control" name="name"   >
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{trans('custom.email')}}</label>
                            <input  type="email" class="form-control" name="email"   >
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{trans('custom.address')}}</label>
                            <input value="{{old('address')}}" type="text" class="form-control" name="address"   >
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{trans('custom.subject')}}</label>
                            <input value="{{old('subject')}}" type="text" class="form-control" name="subject"  >
                            @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{trans('custom.message')}}</label>
                            <textarea required="required" rows="4" cols="50" name="message"
                                      placeholder="Enter your inquiry details such as product name, color, size, MOQ, FOB, etc." class="form-control"
                                      style=" resize: none"></textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- files -->
                        <div class="form-group col-lg-6 col-12">
                            <label>{{trans('custom.file')}}</label>

                            <p class="text-danger">* {{trans('custom.attachment_format')}} pdf, jpeg ,.jpg , png </p>
                            <input type="file" class="form-control" name="file" >

                        </div>
                        <!-- end file -->
                        <div class="form-group">

                            <input type="submit" class="btn bg1 cl0 p-lr-50" value="{{trans('custom.send')}}">
                        </div>
                    </form>
                </div>
            </div>
        @else

        @endif

    </div>
</section>


@stop
@section('js')
    <script type="text/javascript">
        $(function(){
            $(".cont-sup").on('click',function(){
                $("html,body").animate({
                    scrollTop:$("#cont-sup").offset().top
                });
            });
        });
    </script>

@stop
