@extends('layouts.website.master')
@section('title',trans('custom.trending_product'))
@section('content')


<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.trending_product')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-23 p-b-140">
        <div class="p-b-10 separator m-b-20">
            <div class="flex-center bg1 p-0  b-rt-lb-20">
                <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                    {{trans('custom.trending_product')}}
                </h3>
            </div>
        </div>
    <div class="container-fluid">
        <div class="row isotope-grid">

            <div class="col-12 col-md-12 col-lg-12 p-b-35 isotope-item women  p-lr-70  p-r-0-md p-l-0-md ">        
                <div class="row">
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-20 m-b-20">  
                                <div class="block2  bg-s2">
                                    <div class="block2-pic hov-img0">
                                        <a href="{{route('product.details',['id' => $product->id, 'slug' => $product->slug])}}">
                                            @if($product->firstMedia)
                                                <img  src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}"
                                                    style="
                                                            border-radius: 30px;
                                                            padding: 10px 10px;right:0;">
                                            @else
                                                <img  src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}"
                                                style="
                                                        border-radius: 30px;
                                                        padding: 10px 10px;right:0;">
                                            @endif
                                        </a>
                                
                                    </div>
        
                                    <div class="block2-txt">
                                        <div class=" flex-col-l p-r-l-5">
                                            <a href="{{route('product.details',['id' => $product->id, 'slug' => $product->slug])}}" 
                                                class="  mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full card-title-name-home-cat">
                                                {{$product->name}}
                                            </a>
        
                                            <span class="cl1 w-full p-r-l-5 p-tb-5 mtext-1075">
                                                {{$code}}{{$product->price}}
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
                                                <button  class="three btn btn-contact btn-chat hover-shadow cl0 bg2 f-s-s addToFavourte {{$product->IsFavourite?'cl1':''}}" data-productid="{{$product->id}}" data-companyid="{{auth('company')->user()?auth('company')->user()->id:''}}">
                                                    <i class="fa-solid fa-heart " style="pointer-events:none;"></i></button>
        
                                            </div>



                                           {{-- <div class="flex-product">


                                                <a class="cont-sup " href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug.'#get_form']) }}">
                                                    <button class=" cl0 bg1 p-tb-5   m-t-5 btn btn-contact p-lr-5-md p-lr-5-xl p-lr-10-xll f-s-s">
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
                            <p class="text-danger alert alert-danger">{{trans('custom.products_not_found')}}
                            </p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
        {{$products->onEachSide(0)->links()}}
    </div>   
</section>


@stop
