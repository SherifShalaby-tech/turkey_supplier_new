@extends('layouts.website.master')
@section('title','products')
@section('content')
<style>
        .card-title-name{
        width: 313px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: start;
    }

    @media (max-width:1440px) {
        .shipping .block2-pic img{
            height: 270px !important;
        }
        .card-title-name{
            width: 260px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: start;
        }
        .card-title {
            margin: 0;
        }
    }

    @media (max-width:1400px) {
        .shipping .block2-pic img{
            height: 260px !important;
        }
        .card-title-name{
            width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: start;
        }
        .card-title {
            margin: 0;
        }
    }
    @media (max-width:1024px) {
        .shipping .block2-pic img{
            height: 206px !important;
        }
        .card-title-name{
            width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: start;
        }
        .card-title {
            margin: 0;
        }
    }


    @media (max-width: 768px){
        .card-title-name {
            width: 140px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .shipping .block2-pic img{
            height: 142px !important;
        }
        .stext-105{
            font-size: 19px;
        }
        .card-title {
            margin: 0;
        }
    }

    @media (max-width: 425px){
        .card-title-name {
            width: 160px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .shipping .block2-pic img{
            height: 162px !important;
        }
        .stext-105{
            font-size: 21px !important;
        }
        .card-title {
            font-size: 21px !important;
        }
    }
    @media (max-width: 390px){
        .card-title-name {
            width: 140px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .shipping .block2-pic img{
            height: 145px !important;
        }
        .stext-105{
            font-size: 17px !important;
        }
    }

    @media (max-width: 375px){
        .card-title-name {
            width: 130px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .shipping .block2-pic img{
            height: 137px !important;
        }
        .stext-105{
            font-size: 17px !important;
        }
    }
    @media (max-width: 320px){
        .card-title-name {
            width: 100px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .shipping .block2-pic img{
            height: 110px !important;
        }
        .stext-105{
            font-size: 13px !important;
        }
    }

</style>
    <div class="shipping text-center mt-3 p-5">
        <div class="container-fluid">
            <h2 class="mb-4">{{trans('custom.products')}}</h2>
            <div class="row">
                {{-- @if($category->products->count() > 0) --}}
                @if($subcategory->products->count() > 0)
                    @foreach($subcategory->products as $product)

                        <div class="col-sm-6 col-md-3 col-lg-3 col-6 p-b-35 isotope-item women">
                            <div class="block2 effect8" style=" width: 100%;  height: auto; padding:10px;
                            filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                <div class="block2-pic hov-img0">
                                       @if($product->firstMedia)
                                        <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                    style="max-width: 100%;  height: 370px;width: 100% !important;
                                                            background-size: cover;
                                                            background-repeat: no-repeat;
                                                            background-position: 50% 50%;
                                                            border-radius: 10px;" >
                                        @else
                                             <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                        @endif

                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <h3 class="card-title card-title-name">{{$product->name}}</h3>
                                        <h3 class="flex-t card-title trans-04 js-name-b2 p-b-6"> price : ${{$product->price}}</h3>
                                        <a  href="{{route('product.details',$product->slug)}}"  class="btn bg9 cl0 hov-cl0 stext-105">
                                            {{trans('custom.product_details')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endforeach
                @else
                    <div class="error-not-found">
                        <div class="not-found-msg">
                            <p class="alert alert-danger">{{trans('custom.products_not_found')}}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


@stop
