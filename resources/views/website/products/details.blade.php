@extends('layouts.website.master')
@section('title',$product->name)
@section('css')
    <style>
        .swatches,
        .swatch {
            display: block;
        }
        .swatches:after,
        .swatch:after {
            clear: both;
            content: "";
            display: block;
            visibility: hidden;
            height: 0;
        }
        hgroup,
        main,
        menu,
        section {
            display: block;
        }
        .product-detail {
            padding-top: 15px;
        }

        .swatches {
            margin: 17px 0;
        }

        .swatches .header {
            font-size: 22px;
            font-weight: 100;
            font-family: 'CustomFont';
        }


        .swatch {
            float: left;
            margin-right: 40px;
        }

        .swatch:nth-last-child(2) {
            margin-right: 0;
        }

        .swatch .header {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px;
            margin-right: 7px;
            text-transform: uppercase;
        }

        .swatch input {
            display: none;
        }

        .swatch .swatch-element {
            float: left;
            margin: 5px 8px 0 0;
            position: relative;
        }

        .swatch .color label {
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            -moz-border-radius:7px;
            -webkit-border-radius: 7px;
            border-radius: 7px;
            border: 1px solid;
            cursor: pointer;
            display: block;
            height: 40px;
            padding: 7px 0 0 7px;
            width: fit-content;
            font-family: Arial, Helvetica, sans-serif;

        }


        .swatch .plain label {
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 5px;
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid #086fcf;
            color: #086fcf;
            cursor: pointer;
            display: block;
            height: 40px;
            padding: 8px;
            text-align: center;
            width: fit-content;
        }

        .swatch input:not(:checked) + label {
            border-color: #edeff2 !important;
        }

        .swatch input:not(:checked) + label:hover {
            border-color: #b5b6bd !important;
        }

        .swatch .plain input:not(:checked) + label {
            color: #16161a !important;
        }

        .swatch .blue input:checked + label {
            border-color: #086fcf !important;
        }


        .crossed-out {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
        }

        .swatch .swatch-element .crossed-out {
            display: none;
        }


        .swatch .tooltip {
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            text-align: center;
            background-color: rgba(22, 22, 26, 0.93);
            color: #fff;
            bottom: 100%;
            padding: 10px;
            display: block;
            position: absolute;
            width: 100px;
            left: -23px;
            margin-bottom: 15px;
            filter: alpha(opacity=0);
            -khtml-opacity: 0;
            -moz-opacity: 0;
            opacity: 0;
            visibility: hidden;
            -webkit-transform: translateY(10px);
            -moz-transform: translateY(10px);
            -ms-transform: translateY(10px);
            -o-transform: translateY(10px);
            transform: translateY(10px);
            -webkit-transition: all 0.25s ease-out;
            -moz-transition: all 0.25s ease-out;
            -ms-transition: all 0.25s ease-out;
            -o-transition: all 0.25s ease-out;
            transition: all 0.25s ease-out;
            -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
            -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
            -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
            -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
            z-index: 10000;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .swatch .tooltip:before {
            bottom: -20px;
            content: " ";
            display: block;
            height: 20px;
            left: 0;
            position: absolute;
            width: 100%;
        }

        .swatch .tooltip:after {
            border-left: solid transparent 10px;
            border-right: solid transparent 10px;
            border-top: solid rgba(22, 22, 26, 0.93) 10px;
            bottom: -10px;
            content: " ";
            height: 0;
            left: 50%;
            margin-left: -13px;
            position: absolute;
            width: 0;
        }

        .swatch .swatch-element:hover .tooltip {
            filter: alpha(opacity=100);
            -khtml-opacity: 1;
            -moz-opacity: 1;
            opacity: 1;
            visibility: visible;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px);
        }

        .img-color{
            border-radius: 50%;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            position: relative;
            top: -3px;
            right: 3px;
        }

        table{
            font-size: 22px;
            width: 100% !important;
            border: #e1e1e1 1px solid;
            font-family: Arial, Helvetica, sans-serif;
        }
        table td{
            border: #e1e1e1 1px solid;
        }
        .table td, .table th {
            padding: .45rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            width: fit-content;
        }


        /*product-details */
        .product-details{
            padding-top: 70px;
            padding-bottom: 50px;
        }

        .product-details-slider
        {
            /*right:5px;*/
            margin-bottom: 20px;
        }

        .product-details-slider .item
        {
            /*right:5px;*/
            height: 500px;
            margin-bottom: 20px;
        }

        .product-details-thumb
        {
            margin-left:10px;
            margin-bottom: 20px;
        }

        .product-details-thumb .thumb
        {
            margin-right: 20px;
            height: 80px;
            cursor: pointer;
            position: relative;
        }

        .product-details-thumb .thumb::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: rgb(0, 0, 0);
            opacity: 0;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .product-details-thumb .thumb.active::after {
            opacity: 0.33;
        }

        /*.product-details-thumb .item img {
            height: 116px


        }*/

        .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
            outline: none;
            height: 100px;
            /*background-color: rgba(103, 103, 103, 0.7);*/
        }

        .owl-nav .owl-prev.disabled,
        .owl-nav .owl-next.disabled {
            opacity: 0.33;

            cursor: default;
            /*display: none;*/
        }

        .owl-nav button svg {
            width: 33px;
            height: 33px;

        }

        .owl-nav button.owl-prev { /*button "<" position*/
            left: -33px;
        }

        .owl-nav button.owl-next { /*button ">" position, relative position is:(position of button "<")-20*/
            right: -12px;
        }

        .owl-nav button span {
            font-size: 33px;
        }


        /* btn */
        .product-actions .btn:active, :hover, :focus {
            outline: 0!important;
            outline-offset: 0;
        }
        .product-actions .btn::before,
        ::after {
            position: absolute;
            content: "";
        }

        .product-actions .btn {
            position: relative;
            display: inline-block;
            width: auto; height: auto;
            background-color:  #3fa6c3;
            border: none !important;
            cursor: pointer;
            margin: 50px auto 14px;
            min-width: 160px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
            padding: 10px 0px !important;
        }
        .product-actions .btn p {
            position: relative;
            display: inline-block;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            top: 0; left: 0;
            width: 100%;
            padding: 15px 20px;
            transition: 0.3s;
        }
        /*--- btn-3 ---*/
        .product-actions .btn-3 {
            padding: 5px 10px;
        }

        .product-actions .btn-3::before,
        .btn-3::after {
            background: transparent;
            z-index: 2;
        }
        /* 11. hover-border-1 */
        .product-actions .btn.hover-border-1::before,
        .btn.hover-border-1::after {
            width: 10%; height: 25%;
            transition: 0.35s;
        }
        .product-actions .btn.hover-border-1::before {
            top: 0; left: 0;
            border-left: 1px solid rgb(28, 31, 30);
            border-top: 1px solid rgb(28, 31, 30);
        }
        .product-actions .btn.hover-border-1::after {
            bottom: 0; right: 0;
            border-right: 1px solid rgb(28, 31, 30);
            border-bottom: 1px solid rgb(28, 31, 30);
        }
        .product-actions .btn.hover-border-1:hover::before,
        .btn.hover-border-1:hover::after {
            width: 99%;
            height: 98%;
        }
        .product-actions .btn-cart{
            background: #4bb1cb;
            border: none !important;
            color: #fff !important;
            font-size: 26px;
            letter-spacing: 1px;
        }
        /* */
        .contact-supplier .btn-chat{
            margin: 7px 0;
        }
        .contact-supplier .btn a{
            color: #333;
        }

        /*c ard  */

        .box {
            width: 15rem;
            height: 20rem;
            padding: 0 2rem 3rem;
            transition:
                transform 0.3s linear 0s,
                filter 0.5s linear 0.3s,
                opacity 0.5s linear 0.3s;
            /*transform-origin: top center;*/
        }
        .product {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 0.2rem;
            background-color: #fff;
            background-position: top 3rem center;
            background-size: 80%;
            background-repeat: no-repeat;
            box-shadow: 0 0.1rem 0.2rem rgba(0, 0, 0, 0.1);
            transition:
                box-shadow 0.5s linear,
                height 0.1s linear 0s;
        }
        .name {
            display: block;
            padding: 1rem 0.5rem;
        }
        .description {
            position: absolute;
            bottom: 1rem;
            left: 0;
            right: 0;
            display: block;
            padding: 0 1.5rem;
            opacity: 0;
            transition: opacity 0.1s linear 0s;
        }
        .wrapper:hover .box:not(:hover)  {
            filter: blur(3px);
            opacity: 0.5;

        }
        .box:hover  {
            transform: scale(1);
            transition:
                transform 0.3s linear 0.3s,
                filter 0.1s linear 0s,
                opacity 0.1s linear 0s;

        }
        .box:hover .product {
            height: 20rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);
            transition:
                box-shadow 1s linear,
                height 0.3s linear 0.5s;

        }
        .box:hover .description {
            opacity: 1;
            transition: opacity 0.3s linear 0.75s;

        }
        .btn-contact{
            background-color: #fff;
            color:#3797b1 !important;
            border:#3797b1 1px solid;
        }
        .contact-supplier .btn a{
            background-color: #fff;
            color:#3797b1 !important;
            text-decoration: none;
        }
        .btn-contact:hover{
            background-color: #3797b1;
            color: #fff !important;
        }
        .contact-supplier .btn a:hover{
            background-color: #3797b1;
            color:#fff !important;
            text-decoration: none;
        }

        .img-ar{
            position: relative;
            left: 1400px !important;
            z-index: 99999;
        }
        .online-ar{
            position: absolute;
            top: 63px !important;
            left: 150px !important;
        }
        .online{
            top: 63px !important;
        }

        .font-details p{
            font-size: 22px;
            font-weight: 100 !important;

        }
        table tr th{
            font-weight: 400;
        }


        .btn-cart{
            font-size: 22px;
        }

        .btn-contact-tr{
            width:222px !important;
        }
        .product-image{
            position: relative;
            margin-top: 20px;
            height: 500px;
            width: 100%;
            overflow: hidden;
        }
        .product-details p{
            font-family: Arial, Helvetica, sans-serif !important;
        }
        .productDetails p,span{
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: 400;
        }
        form label{
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: 400;
        }
        .card-title-name{
        width: 245px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .details-product p{
        font-size: 22px;

    }
    /* */

    .three i {
    cursor:pointer;
    padding:10px 12px 8px;
    background:#fff;
    border-radius:50%;
    display:inline-block;
    margin:0 0 15px;
    color: #bd0000;
    transition:.2s;
    }

    .three i:hover {
    color:rgb(184, 63, 63);
    }
    .bold-text{
        font-weight: 800;
    }
@media (max-width:1900px) {
    .card-title-name{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
}
@media (max-width:1440px) {
    .card-title-name{
        width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-details .preview-pic .product-details-slider img{
        height: 395px !important;
    }
    .product-details-slider .item {
        height: 400px !important;
        margin-bottom: 10px;
    }

    .block2{
        height: 350px !important;
    }
    .isotope-grid .block2 .img-1400 img{
        height: 250px !important;
    }
    .my-gallery .effect-lily img{
        height: 98px !important;
    }
}

@media (max-width:1400px) {
    .card-title-name{
        width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-details .preview-pic .product-details-slider img{
        height: 383px !important;
    }
    .product-details-slider .item {
        height: 383px !important;
        margin-bottom: 10px;
    }

    .block2{
        height: 350px !important;
    }
    .isotope-grid .block2 .img-1400 img{
        height: 250px !important;
    }
    .my-gallery .effect-lily img{
        height: 94px !important;
    }
}

@media (max-width:1024px) {
    .card-title-name{
        width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-details .preview-pic .product-details-slider img{
        height: 311px !important;
    }
    .product-details-slider .item {
        height: 311px !important;
        margin-bottom: 10px;
    }
    .s-img{
        height: 57px !important;
    }
    .s-img img{
        height: 57px !important;
    }

    .block2{
        height: 280px !important;
    }
    .isotope-grid .block2 .img-1400 img{
        height: 186px !important;
    }    .my-gallery .effect-lily img{
        height: 70px !important;
    }
}


@media (max-width:786px) {
    .card-title-name{
        width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-details .preview-pic .product-details-slider img{
        height: 226px !important;
    }
    .product-details-slider .item {
        height: 226px !important;
        margin-bottom: 10px;
    }
    .s-img{
        height: 36px !important;
    }
    .s-img img{
        height: 36px !important;
    }

    .block2{
        height: 280px !important;
    }
    .isotope-grid .block2 .img-1400 img{
        height: 186px !important;
    }
    .my-gallery .effect-lily img{
        height: 78px !important;
    }
}

@media (max-width:425px) {
    .card-title-name{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-details .preview-pic .product-details-slider img{
        height: 395px !important;
    }
    .product-details-slider .item {
        height: 395px !important;
        margin-bottom: 10px;
    }
    .s-img{
        height:78px !important;
    }
    .s-img img{
        height: 78px !important;
    }

    .block2{
        height: 480px !important;
    }
    .isotope-grid .block2 .img-1400 img{
        height: 355px !important;
    }
    .my-gallery .effect-lily img{
        height: 163px !important;
    }
}

@media (max-width:375px) {
    .card-title-name{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-details .preview-pic .product-details-slider img{
        height: 345px !important;
    }
    .product-details-slider .item {
        height: 345px !important;
        margin-bottom: 10px;
    }
    .s-img{
        height:66px !important;
    }
    .s-img img{
        height: 66px !important;
    }

    .block2{
        height: 420px !important;
    }
    .isotope-grid .block2 .img-1400 img{
        height: 305px !important;
    }
    .my-gallery .effect-lily img{
        height: 137px !important;
    }
}


    </style>
@stop
@section('content')
    <div class="product-details spad p-5 ">
        <div class="container-fluid">
            <div class="row">

                <div class="preview col-lg-4  col-md-4 col-sm-12">
                    <div class="preview-pic tab-content">

                        <div id="slider" class="owl-carousel product-details-slider ">
                            @if($product->media()->count() > 0)
                                @foreach($product->media as $media)
                                <div class="item  product-image  @if (app()->getLocale() == 'ar') product-image-ar @endif"
                                 style=" @if (app()->getLocale() == 'ar')
                                position: relative;
                                z-index: 90000;
                                height: auto;
                                @endif">
                                        <img class="image"
                                            src="{{ asset('images/products/'. $media->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                style="  max-width: 100%;  height: 500px;width: 100% !important;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: 50% 50%;
                                                border-radius: 10px;transition: transform 0.8s ease-out;" >
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div id="thumbs" class="owl-carousel product-details-thumb">
                            @if($product->media()->count() > 0)
                                @foreach($product->media as $media)
                                    <div class="thumb s-img">
                                        <img  src="{{ asset('images/products/' . $media->file_name) }}" alt="{{ $product->name }}" class=" img-fluid w-100"
                                              style="max-width: 100%;  height: 80px;width: 100% !important;
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: 50% 50%;
                                            border-radius: 4px;
                                            ">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="product-actions">
                            <form style="display: inline-block" class="form-cart" action="{{route('carts.add.product')}}" method="POST">
                                @csrf
                                @if(auth('company')->user())
                                    <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                @endif
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button class="btn btn-cart  hover-shadow" type="submit">{{trans('custom.add_to_cart')}}</button>
                            </form>
                            <form style="display: inline-block" action="{{route('carts.add.product')}}" method="POST">
                                @csrf
                                @if(auth('company')->user())
                                    <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                @endif
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="btn btn-cart  hover-shadow">{{trans('custom.buy_now')}}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4  col-md-4 col-sm-12">
                    <div class="details mt-3 font-details">
                        <p>  <span class="bold-text">{{trans('custom.name')}} </span> : {!! $product->name !!}</p>
                        <p> <span class="bold-text"> {{trans('custom.product_code')}} </span> : {{$product->code}}</p>
                        <p> <span class="bold-text"> {{trans('custom.supplier_name')}} </span>  : <a href="{{route('supplier.profile',$product->company->id)}}">{{$product->company->name}}</a></p>
                        <p> <span class="bold-text"> {{trans('custom.price')}} </span>  : <span style="margin-left: 10px">${{$product->price}}</span></p>

                        <p ><i class="fa-solid fa-eye"></i> :  <span style="margin-left: 10px">{{$product->views}}</span></p>


                        {{-- <b>Supplier Name</b> <span><a href="{{route('supplier.profile',$product->company->phone)}}">{{$product->company->name}}</a></span> --}}
                        <div class="product-rate">
                            @foreach($product->rating as $rate)
                                <span class="fa fa-star checked"></span>
                            @endforeach
                        </div>
                        <hr style="border-color: black">
                        @if($product->description)
                            <p>{{trans('products.description')}} : {!! $product->description !!} </p>
                        @endif
                        @if($product->certificates->count() > 0)
                            <p>{{trans('products.certificates')}} : </p>
                            <div class="card-body my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                            <div class="grid-hover row">
                                @forelse ( $product->certificates as $media)
                                    <div class="col-lg-4 col-6">
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
                                                    {{-- <h2 style="color:black;"><span >{{ $company->name }}</span></h2> --}}
                                                    {{-- <p style="color:black;">{!!  $company->description  !!}</p> --}}
                                                </div>
                                                {{-- <a href="{{ route('admin.products.showdata',$product->id) }}">View more</a> --}}
                                            </figcaption>
                                        </figure>
                                    </div>
                                @empty
                                    <div class="alert alert-danger">{{trans('product.certificates_not_found')}}</div>
                                @endforelse
                            </div>
                        </div>
                        @endif
                        @if($product->Applicable_Industries)
                        <hr style="border-color: black">
                        <p>{{trans('custom.essential_details')}}
                            <br>
                        <p>
                            <a>{{trans('custom.applicable_industries')}}:</a>
                            <span style="margin-left: 10px">{{$product->Applicable_Industries ?? '-'}}</span>
                        </p>
                        @endif
                        <br>
                        @if($product->Place_Origin)
                            <p>
                                <a>{{trans('custom.place_origin')}}:</a>
                                <span style="margin-left: 10px">{{$product->Place_Origin ?? '-'}}</span>
                            </p>
                        @endif
                        @if($product->Supply_Ability)
                        <hr style="border-color: black">
                            <p>{{trans('custom.Supply_Ability')}}</p>
                            <br>
                            <p>
                                <a>{{trans('custom.Supply_Ability')}} :</a>
                                <span style="margin-left: 10px">{{$product->Supply_Ability ?? '-'}}</span>
                            </p>
                        @endif

                        @if($product->Packaging_delivery)
                            <hr style="border-color: black">
                            <p>{{trans('custom.Packaging_delivery')}}</p>
                            <br>
                            <p>
                                <a>{{trans('custom.Packaging_delivery')}}</a>
                                <span style="margin-left: 10px"> {{$product->Packaging ?? '-'}}</span>
                            </p>
                        @endif
                        <br>

                        <div class="swatches">
                            <div class="swatch clearfix" data-option-index="0">
                                <div class="header">{{trans('custom.size')}}</div>
                                @if($product->sizes)
                                    @foreach($product->sizes as $size)
                                        <div data-value="{{$size->sizeName}}" class="swatch-element plain {{$size->sizeName}} available">
                                            <input id="swatch-0-m" type="radio" name="option-0" value="{{$size->sizeName}}" checked  />
                                            <label for="swatch-0-m">
                                                {{$size->sizeName}}
                                                <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="swatch clearfix" data-option-index="1">
                                <div class="header">{{trans('custom.color')}}</div>
                                @if($product->colors)
                                    @foreach($product->colors as $color)
                                        <div data-value="{{$color->colorName}}" class="swatch-element color {{$color->colorName}} available">
                                            <input quickbeam="color" id="swatch-1-{{$color->colorName}}" type="radio" name="option-1" value="{{$color->colorName}}"  />
                                            <label for="swatch-1-{{$color->colorName}}" style="border-color: {{$color->colorName}}; ">
                                                <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                {{$color->colorName}}
                                            </label>
                                            <label for="swatch-1-{{$color->colorCode}}" style="border-color: {{$color->colorCode}}; ">
                                                <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                {{$color->colorCode}}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-sm-12 mt-3 text-center">
                    <div class="contact-supplier">
                        <p>{{trans('custom.For_product_pricing_customization_or_other_inquiries')}}</p>

                        <a class="cont-sup " href="#">
                            <button class="three btn btn-contact @if (app()->getLocale() == 'tr')  btn-contact-tr @endif">{{trans('custom.contact_supplier')}}</button>
                        </a><br>

{{--                        <a href="{{route('chat',$product->company_id)}}">--}}
{{--                            <button class="three btn btn-contact btn-chat hover-shadow @if (app()->getLocale() == 'tr')   btn-contact-tr @endif">{{trans('custom.chat_now')}}</button>--}}
{{--                        </a><br>--}}
                        <form action="{{route('carts.add.product')}}" method="POST">
                            @csrf
                            @if(auth('company')->user())
                                <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                            @endif
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button type="submit" class="three btn btn-contact @if (app()->getLocale() == 'tr') btn-contact-tr @endif">{{trans('custom.get_a_sample')}}</button>
                        </form>
                        <form action="{{route('fav.add')}}" method="POST">
                            @csrf
                            @if(auth('company')->user())
                                <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
                            @endif
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button class="three btn btn-contact btn-chat hover-shadow @if (app()->getLocale() == 'tr')   btn-contact-tr @endif" style="height: 52px;">
                                {{trans('custom.add_to_favorites')}} <i class="fa-solid fa-heart"></i></button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-12 mt-3 ">

                </div>
                <div class="col-lg-8 col-sm-12 mt-3">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>{{trans('custom.qty')}}</th>
                            <td>1 -20</td>
                            <td>21 -50</td>
                            <td>51 - 100</td>
                            <td> > 100</td>
                        </tr>
                        <tr>
                            <th>{{trans('custom.lead_time_days')}}</th>
                            <td>5</td>
                            <td>7</td>
                            <td>10</td>
                            <td>to be negotiated</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- -->

    <section class="bg0 p-t-23 p-b-140 p-5">
        <div class="container-fluid">
            <h3 class="mb-3">{{trans('custom.You_may_also_like')}}</h3>
            <div class="row isotope-grid">
                @if($related_product->count() > 0)
                    @foreach($related_product as $product_r)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                            <div class="block2 effect8" style=" width: 100%;  height: 450px; padding:10px 20px 0 20px;
                             filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                <div class="block2-pic hov-img0 img-1400">
                                    <a href="{{route('product.details',$product_r->slug)}}">
                                        @if($product_r->firstMedia)
                                            <img src="{{ asset('images/products/'.$product_r->firstMedia->file_name) }}" alt="{{ $product_r->name }}" class=" img-fluid w-100"
                                                 style="max-width: 100%;  height:300px ;width: 100% !important;
                                                        background-size: cover;
                                                        background-repeat: no-repeat;
                                                        background-position: 50% 50%;
                                                        border-radius: 7px;">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $product_r->name }}" class="img-fluid w-100"
                                                   style="max-width: 100%;  height:300px ;width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    border-radius: 7px;">
                                        @endif
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{route('product.details',$product_r->slug)}}" class="stext-104 cl7 hov-cl1 trans-04 js-name-b2 p-b-6 card-title-name">
                                            {{$product_r->name}}
                                        </a>
                                        <span class="stext-105 cl7">
                                        ${{$product_r->price}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{$related_product->onEachSide(0)->links()}}
                @else
                    <div class="add-address" style="margin-bottom: 135px">
                        <p class="text-danger alert alert-danger">There are no search results !
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </section>



    <!-- -->
    <div class="details-product mt-4 p-5">
        <div class="container-fluid">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="font-size: 22px;">--}}
{{--                        {{trans('custom.product_details')}}</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"
                     style="font-size: 24px; color: #fff !important;letter-spacing: 1px;">
                        {{trans('custom.company_profile')}}</a>
                </li>
            </ul>
            <div class="tab-content productDetails" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">{{trans('custom.Specification')}} <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Products_Description')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Recommend_Products')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Company_Introduction')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Panking_Delivery')}}</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
{{--                    <p>{{trans('custom.Overview')}}</p>--}}
{{--                    <hr style="border-color: black">--}}
{{--                    <p>{{trans('custom.essential_details')}}</p>--}}
{{--                    <br>--}}
{{--                    @if($product->Applicable_Industries)--}}
{{--                        <p>Applicable Industries:  <span style="margin-left: 40px">{{$product->Applicable_Industries ?? '-'}}</span> </p>--}}
{{--                        <br>--}}
{{--                        <hr style="border-color: black">--}}
{{--                    @endif--}}
{{--                    @if($product->Supply_Ability)--}}
{{--                        <p>{{trans('custom.Supply_Ability')}}</p>--}}
{{--                        <br>--}}
{{--                        <p>{{trans('custom.Supply_Ability')}}   <span style="margin-left: 40px">{{$product->Supply_Ability ?? '-'}}</span></p>--}}
{{--                        <br>--}}
{{--                        <hr style="border-color: black">--}}
{{--                    @endif--}}
{{--                    @if($product->Packaging_delivery)--}}
{{--                        <p>{{trans('custom.Packaging_delivery')}}</p>--}}
{{--                        <br>--}}
{{--                        <p>{{trans('custom.Packaging_&_delivery')}} :   <span style="margin-left: 40px">{{$product->Packaging ?? '-'}}</span></p>--}}
{{--                        <br>--}}
{{--                        <hr style="border-color: black">--}}
{{--                    @endif--}}
{{--                    @if($product->video_description !== null)--}}
{{--                        <p>{{trans('custom.video_description')}}</p>--}}
{{--                        <br>--}}
{{--                        <video width="400" controls class="mt-3">--}}
{{--                            <source src="{{$product->video_description}}" type="video/mp4">--}}
{{--                            Your browser does not support HTML video.--}}
{{--                        </video>--}}
{{--                    @endif--}}

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">{{trans('custom.Specification')}} <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Products_Flow')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Factory_Information')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Company_Introduction')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">{{trans('custom.Panking_Delivery')}}</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <p style="display: block;border-bottom: 1px dotted">{{trans('custom.COMPANY_OVERVIEW')}}</p>
                    <br>
                    <p>{{trans('custom.Company_Album')}}</p>
                    <div class="row">
                        @if($product->company->media->count() > 0)
                            @foreach($product->company->media as $media)
                                <div class="col-3">
                                    <img src="{{asset('images/companies/' . $media->file_name)}}" width="100%">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg0 p-t-23 p-b-140 p-5">
        <div class="container-fluid">
            <h3 class="mb-3">{{trans('custom.Recommended_by_seller')}}</h3>
            <div class="row isotope-grid">
                @if($Other_products->count() > 0)
                    @foreach($Other_products as $product_o)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                            <div class="block2 effect8" style=" width: 100%;  height: 390px; padding:10px 20px 0 20px;
                            filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                <div class="block2-pic hov-img0 img-1400">
                                    <a href="{{ route('product.details',$product_o->slug) }}">
                                        @if($product_o->firstMedia)
                                            <img src="{{ asset('images/products/'.$product_o->firstMedia->file_name) }}" alt="{{ $product_o->name }}" class="img-fluid w-100"
                                                 style="max-width: 100%;  height:250px ;width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        border-radius: 7px; " >
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $product_o->name }}" class="img-fluid w-100"
                                                    style="max-width: 100%;  height:250px ;width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    border-radius: 7px; " >
                                        @endif
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{route('product.details',$product_o->slug)}}" class="stext-104 cl7 hov-cl1 trans-04 js-name-b2 p-b-6 card-title-name">
                                            {{$product_o->name}}
                                        </a>
                                        <span class="stext-105 cl7">
                                        ${{$product_o->price}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="add-address" style="margin-bottom: 135px">
                        <p class="text-danger alert alert-danger">{{trans('custom.products_not_found')}}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <div class="product_description p-5">
{{--                        <p>{{trans('custom.Product_Description')}}</p>--}}
{{--                        <hr style="border-color: black">--}}
{{--                        <p class="text-center">{!! $product->description !!}--}}
{{--                        </p>--}}
        {{-- <div class="product_images text-center">
            <div class="row">
                @if($product->image)
                    @foreach($product->image as $img)
                        <div class="col-6 mb-2">
                            <img src="{{asset('images/products/' . $img)}}" width="80%">
                        </div>
                    @endforeach
                @endif
            </div>
        </div> --}}
{{--                        <div class="our-factory">--}}
{{--                            <p>{{trans('custom.our_factory')}}</p>--}}
{{--                            <hr style="border-color: black">--}}
{{--                            <p>{{$product->user->company->factory->description ?? '-'}} </p>--}}
{{--                        </div>--}}
        <div id="cont-sup" class="send-to-supplier">
            @if(Auth::guard('company')->user() && Auth::guard('company')->user()->trade_role == 'buyer')
                <p>{{trans('custom.Send_your_message_to_this_supplier')}}</p>
                <form action="{{route('contact_supplier')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($product->company)
                        <input type="hidden" name="supplier_id" value="{{$product->company->id}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                    @endif
                    @if(auth('company')->user())
                        <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                    @endif
                    <div class="form-group">
                        <label>{{trans('custom.to')}}:</label>
                        @if($product->company)
                            <span>{{$product->company?->name}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{trans('custom.name')}}</label>
                        {{-- @if(auth('company')->user()) --}}
                        <input value="{{auth('company')->user()->name}}" type="text" class="form-control" name="name"  disabled>
                        {{-- @else
                        <input  type="text" class="form-control" name="name" style="width: 50%" >
                        @endif --}}
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{trans('custom.email')}}</label>
                        {{-- @if(auth('company')->user()) --}}
                        <input value="{{auth('company')->user()->email}}" type="email" class="form-control" name="email"  disabled>
                        {{-- @else
                            <input  type="email" class="form-control" name="email" style="width: 50%" >
                        @endif --}}
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{trans('custom.address')}}</label>
                        <input value="{{old('address')}}" type="text" class="form-control" name="address" >
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{trans('custom.subject')}}</label>
                        <input value="{{old('subject')}}" type="text" class="form-control" name="subject" >
                        @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{trans('custom.message')}}</label>
                        <textarea required="required" rows="4" cols="50" name="message"
                                  placeholder="Enter your inquiry details such as product name, color, size, MOQ, FOB, etc." class="form-control"
                                  style="resize: none"></textarea>
                        @error('message')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- files -->
                    <div class="form-group">
                        <label>{{trans('custom.file')}}</label>

                        <p class="text-danger">* {{trans('custom.attachment_format')}} pdf, jpeg ,.jpg , png </p>
                        <input type="file" class="form-control" name="file" style="width: 50%">

                    </div>
                    <!-- end file -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="{{trans('custom.send')}}">
                    </div>
                </form>
            @elseif (Auth::guard('admin')->user() )
                {{-- انا ادمن --}}
            @elseif (Auth::guard('company')->user())
                {{-- انا seller --}}
            @elseif(!Auth::user())
                <p>{{trans('custom.Send_your_message_to_this_supplier')}}</p>
                <form action="{{route('visitorContactSupplier')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($product->company)
                        <input type="hidden" name="supplier_id" value="{{$product->company->id}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                    @endif
                    <div class="form-group">
                        <label>{{trans('custom.to')}}:</label>
                        @if($product->company)
                            <span>{{$product->company?->name}}</span>
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
                    <div class="form-group">
                        <label>{{trans('custom.file')}}</label>

                        <p class="text-danger">* {{trans('custom.attachment_format')}} pdf, jpeg ,.jpg , png </p>
                        <input type="file" class="form-control" name="file" style="width: 50%">

                    </div>
                    <!-- end file -->
                    <div class="form-group">

                        <input type="submit" class="btn btn-warning" value="{{trans('custom.send')}}">
                    </div>
                </form>
            @else

            @endif



            {{-- <p>{{trans('custom.Send_your_message_to_this_supplier')}}</p>
            <form action="{{route('visitorContactSupplier')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($product->company)
                    <input type="hidden" name="supplier_id" value="{{$product->company->id}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                @endif
                <div class="form-group">
                    <label>{{trans('custom.to')}}:</label>
                    @if($product->company)
                        <span>{{$product->company?->name}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{trans('custom.name')}}</label>
                    <input  type="text" class="form-control" name="name" style="width: 50%" >
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{trans('custom.email')}}</label>
                    <input  type="email" class="form-control" name="email" style="width: 50%" >
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{trans('custom.address')}}</label>
                    <input value="{{old('address')}}" type="text" class="form-control" name="address" style="width: 50%" >
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{trans('custom.subject')}}</label>
                    <input value="{{old('subject')}}" type="text" class="form-control" name="subject" style="width: 50%">
                    @error('subject')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{trans('custom.message')}}</label>
                    <textarea required="required" rows="4" cols="50" name="message"
                    placeholder="Enter your inquiry details such as product name, color, size, MOQ, FOB, etc." class="form-control"
                    style="width: 50%;resize: none"></textarea>
                    @error('message')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- files -->
                <div class="form-group">
                    <label>{{trans('custom.file')}}</label>
                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                    <input type="file" class="form-control" name="file" style="width: 50%">
                </div>
                <!-- end file -->
                <div class="form-group">

                    <input type="submit" class="btn btn-warning" value="{{trans('custom.send')}}">
                </div>
            </form> --}}




        </div>
    </div>


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
