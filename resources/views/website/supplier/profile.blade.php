@extends('layouts.website.master')
@section('title',trans('custom.supplier_profile'))
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.profile')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-5 p-b-120">
    <div class="container-fluid">

       
            <div class="row p-b-10 p-t-0">
                <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                    <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                        <div class="  hov-img0 txt-center">

                             @if($supplier->firstMedia)
                                <img class="circle-img txt-center"  src="{{ asset('images/companies/'.$supplier->firstMedia->file_name) }}" alt="{{ $supplier->name }}"
                                style="max-width: 100%;  height: auto; width: 50% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                padding: 20px;">

                                <p class="cl2 mtext-114 p-b-20">{{$supplier->name}}</p>
                            @else
                                <img class="circle-img txt-center"  src="{{ asset('images/no-image.png') }}" alt="{{ $supplier->name }}" 
                                style="max-width: 100%;  height: auto; width: 50% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                padding: 20px;">

                                <p class="cl2 mtext-114 p-b-20">{{ $supplier->name }}</p>
                            @endif
                           

                        </div>                
                    </div>
                </div>
            </div>  

            <div class="p-b-10 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.bio')}}
                    </h3>
                </div>
            </div>

            <div class="row p-b-70 flex-c-m ">
                <div class="col-md-6 col-lg-6 col-12 txt-center m-t-40 bg0 p-all-20">
                    <div class="col-12 bg0 cl2 mtext-108">       
                        <p>    {!! $supplier->description ?? 'No Description' !!} </p>
                    </div>
                </div>
            </div>  

            <div class="p-b-10 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.my_contact')}}
                    </h3>
                </div>
            </div>

            <div class="row p-b-0 flex-c-m ">
                <div class="col-md-4 col-lg-4 txt-start m-t-40 bg0   bor2 p-all-20">

                    @if ($supplier->phone1 || $supplier->phone2 || $supplier->phone3)
                        <div class="col-12 bg-input1 cl2 m-t-20 m-b-20 mtext-108">  
                            <p> <i class="fa-solid fa-phone"></i> {{$supplier->phone1}}@if($supplier->phone2)-@endif{{$supplier->phone2}}@if($supplier->phone3)-@endif{{$supplier->phone3}}</p>
                        </div>
                    @endif
                    <div class="col-12 bg-input1 cl2 mtext-108">  
                        <p> <i class="fa-solid fa-envelope"></i>   {{$supplier->email}} </p>
                    </div>
                    
                </div>
            </div>  

            <div class="p-b-30 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.supplier_product')}}
                    </h3>
                </div>
            </div>

            <div class="row p-b-0 flex-c-m ">
             
                        @isset($supplier->products)
                            @foreach($supplier->products as $product)
                                <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-20 p-lr-10-md m-tb-10">  
                                    <div class="block2  bg-s2">
                                        <div class="block2-pic hov-img0">
                                            <a href="{{ route('product.details',['id' => $product->id, 'slug' => $product->slug]) }}">
                                                @if($product->firstMedia)
                                                    <img  src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}"
                                                        style="
                                                                border-radius: 30px;
                                                                padding: 5px 5px;right:0;">
                                                @else
                                                   <img  src="{{ asset('images/no-image.jpg') }}" alt="{{ $product->name }}"  
                                                      style="
                                                                border-radius: 30px;
                                                                padding: 5px 5px;right:0;">
                                                @endif
                                            </a>     
                                        </div>
            
                                        <div class="block2-txt  p-t-7">
                                            <div class="flex-col-l p-r-l-5">
                                                <a href="{{ route('product.details',['id' => $product->id, 'slug' => $product->slug]) }}"
                                                    class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full  f-s-s">
                                                    {{$product->name}}
                                                </a>

                                                <span class="cl1 w-full p-r-l-10 p-tb-2 mtext-1075 f-s-s">
                                                    {{$code}} {{$product->price}}
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
            
                                                    <form action="{{route('fav.add')}}" method="POST">
                                                        @csrf
                                                        @if(auth('company')->user())
                                                            <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
                                                        @endif
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <button class="three btn btn-contact btn-chat hover-shadow  bg2 f-s-s addToFavourte {{$product->IsFavourite?'cl1':''}}" data-productid="{{$product->id}}" data-companyid="{{auth('company')->user()?auth('company')->user()->id:''}}">
                                                        <i class="fa-solid fa-heart"></i></button>
                                                    </form>
            
                                                </div>

                                            </div>
            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset

              
            </div>  



    </div>
</section>	

@stop
