@extends('layouts.website.master')
@section('title','fav')
@section('content')

<style>
    .card-title-name{
    width: 313px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: start;
}
@media (max-width: 768px){
    .card-title-name {
        width: 170px !important
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .shipping .block2{
        height: 330px !important;
    }
    .shipping .block2-pic img{
        height: 170px !important;
    }
}
@media (max-width: 390px){
    .card-title-name {
        width: 240px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .shipping .block2{
        height: 410px !important;
    }
    .shipping .block2-pic img{
        height: 250px !important;
    }
}

@media (max-width: 375px){
    .card-title-name {
        width: 240px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .shipping .block2{
        height: 470px !important;
    }
    .shipping .block2-pic img{
        height: 305px !important;
    }
}

</style>
<div class="shipping text-center mt-3 p-5">
    <div class="container-fluid">
        <h3 class="mb-4">{{trans('custom.favorites')}}</h3>
        <div class="row">
            @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-3 col-lg-3 p-b-35 isotope-item women">
                        <div class="block2 effect8" style=" width: 100%;  height: 470px; padding:10px 20px 0 20px;
                    filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                            <div class="block2-pic hov-img0">
                                @if($product->product->firstMedia)
                                    <img src="{{ asset('images/products/' . $product->product->firstMedia->file_name) }}" alt="{{$product->product->name}}" class="img-fluid w-100"
                                         style="max-width: 100%;  height: 310px;width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    border-radius: 10px; " >
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" class="img-fluid w-100"
                                         style="max-width: 100%;  height: 310px;width: 100% !important;
                                                                background-size: cover;
                                                                background-repeat: no-repeat;
                                                                background-position: 50% 50%;
                                                                border-radius: 10px; ">
                                @endif
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <h5 class="card-title card-title-name">{{$product->product->name}}</h5>
                                    <h5 class="flex-t card-title trans-04 js-name-b2 p-b-6"> price : ${{$product->product->price}} </h5>
                                    <a  href="{{route('product.details', $product->product->slug)}}"  class="btn bg9 cl0 hov-cl0 ">
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
