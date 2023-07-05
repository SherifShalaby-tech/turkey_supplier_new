@extends('layouts.website.master')
@section('title','Search')
@section('content')

<section class="bg0 p-t-20 p-b-10">
    <div class="container">
        
        <div class="p-b-10 separator">
            <div class="flex-center bg1 p-0  b-rt-lb-20">
                <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                    {{trans('custom.search_result')}}
                </h3>
            </div>
        </div>
    @if ($products->count() > 0 || $companies->count() > 0 || $categories->count() > 0)
        @if($products->count() > 0)
            <div>
                <div class="separator-f">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.products')}}
                        </h3>
                    </div>
                </div>
                <div class="row ">
                    @foreach($products as $product)
                        <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-10-md m-tb-10">  
                            <div class="block2  bg-s2">
                                <div class="block2-pic hov-img0">
                                    <a href="{{route('product.details',['id' => $product->id, 'slug' => $product->slug])}}">
                                        @if($product->firstMedia)
                                            <img 
                                                src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}"
                                                style="
                                                        border-radius: 30px;right:0;">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}"
                                                style="
                                                        border-radius: 30px;right:0;">
                                        @endif
                                    </a>

                                   {{-- <small class="p-r-l-5 card-title-name-home-cat w-full"> {{$product->description}}</small> --}}
                                  {{--  <small class=" p-r-l-5 card-title-name-home-cat w-full"> {{$product->company->description}}</small> --}}
                                  

                                </div>

                                <div class="block2-txt">
                                     <div class=" flex-col-l p-r-l-5">
                                        <span
                                            class="card-title-name-home-cat p-r-l-5 text-sm mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full ">
                                            {{$product->name}}<br>
                                        </span>
                                        <span class="cl1 w-full p-r-l-5 p-tb-2 mtext-1075 f-s-s">
                                            {{$code}} {{$product->price}}
                                        </span>
                                    </div>  
                           
                                    <div class=" p-lr-0-md p-b-5">
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
                                                <button  class="three btn btn-contact btn-chat hover-shadow  bg2 f-s-s  {{$product->is_like ? 'cl1':'cl0'}}">
                                                <i   class="fa-solid fa-heart "></i></button>
                                            </form> --}}
       <button  class="three btn btn-contact btn-chat hover-shadow cl0 bg2 f-s-s addToFavourte {{$product->IsFavourite?'cl1':''}}" data-productid="{{$product->id}}" data-companyid="{{auth('company')->user()?auth('company')->user()->id:''}}">
                                                    <i class="fa-solid fa-heart " style="pointer-events:none;"></i></button>
                                        </div>
                                    </div>

                                </div>


                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if($companies->count() > 0)
            <div>
                <div class="separator-f">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.suppliers')}}
                        </h3>
                    </div>
                </div>
                <div class="row ">
                    @foreach($companies as $company)
                        <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-10-md m-tb-10">  
                            <div class="block2  bg-s2">
                                <div class="block2-pic hov-img0">
                                    <a href="{{route('supplier.profile',$company->id)}}">
                                        @if($company->firstMedia)
                                            <img 
                                                src="{{ asset('images/companies/'.$company->firstMedia->file_name) }}" alt="{{ $company->name }}"
                                                style="
                                                        border-radius: 30px;right:0;">
                                        @else
                                            <img 
                                            src="{{ asset('images/no-image.png') }}" alt="{{ $company->name }}"
                                                style="
                                                        border-radius: 30px;right:0;">
                                        @endif
                                    </a>
                            
                                </div>

                                <div class="block2-txt  p-t-14">
                                    <div class=" flex-col-l p-r-l-5">
                                        <a href="{{route('supplier.profile',$company->id)}}"
                                            class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full">
                                            {{$company->name}}
                                        </a>

                                        <span class="cl2 w-full p-r-l-10 p-tb-10 mtext-1075">
                                            <i class="fa-solid fa-phone cl1"></i>
                                            {{ $company->phone}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if($categories->count() > 0)
            <div>
                <div class="separator-f">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="ltext-102 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.categories')}}
                        </h3>
                    </div>
                </div>
                <div class="row ">
                    @foreach($categories as $category)
                        <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-lr-10-md m-tb-10">  
                            <div class="block2  bg-s2">
                                <div class="block2-pic hov-img0">
                                    <a href="{{route('category.products',$category->id)}}">
                                        @if($category->image)
                                            <img 
                                                src="{{ asset('images/categories/'.$category->image) }}" alt="{{ $category->name }}"
                                                style="
                                                        border-radius: 30px;right:0;">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $category->name }}"
                                                style="
                                                        border-radius: 30px;right:0;">
                                        @endif
                                    </a>
                            
                                </div>

                                <div class="block2-txt  p-t-14">
                                    <div class=" flex-col-l p-r-l-5">
                                        <a href="{{route('category.products',$category->id)}}"
                                            class="card-title-name-home-cat p-r-l-10 mtext-1075 cl2 hov-cl1 trans-04 js-name-b2  w-full">
                                            {{$category->name}}
                                        </a>

                                        <span class="cl1 w-full p-r-l-10 p-tb-10 mtext-1075">
                                            {{$category->subCategories->count()}} | {{trans('custom.sub_categories')}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endif
        
    @else
        <div class="add-address" style="margin-bottom: 135px">
            <p class="text-danger alert alert-danger">{{trans('custom.products_not_found')}}
            </p>
        </div>
    @endif

    </div>
</section>



@stop