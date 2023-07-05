@extends('layouts.website.master')
@section('title','fav')
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#">{{trans('custom.favorites')}} </a>
        </p>
    </div>
</div>
<section class="bg0 p-t-23 p-b-140">
    <div class="p-b-50 separator">
        <div class="flex-center bg1 p-0  b-rt-lb-20">
            <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                {{trans('custom.favorites')}}
            </h3>
        </div>
    </div>

    <div class="container-fluid p-lr-100 p-r-0-md p-l-0-md">
        <div class="row isotope-grid">
            @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-3 col-lg-3 p-b-35 isotope-item women">
                        <!-- Block2 -->
                        <div class="col-12 bg-s2">
                            <div class="block2">
{{--                                <a  href=""  class="btn btn-red cl0  position-btn-c">--}}
                                    <form action="{{route('fav.remove')}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                        <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                        <input class="btn btn-red cl0  position-btn-c" type="submit" value="X">
                                    </form>
                                <form action="{{route('fav.remove')}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if(auth('company')->user())
                                        <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
                                    @else
                                        <input type="hidden" name="company_id" value="{{$product->company_id}}">
                                    @endif
                                    <input type="hidden" name="fav_id" value="{{$product->id}}">
                                    <input type="hidden" name="user_id" value="{{auth('company')->user()->id}}">
                                    <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                    <button  href="#" class="btn btn-red cl0  position-btn-c">
                                        X
                                    </button>
                                </form>
                                <div class="block2-pic hov-img0">
                                    @if($product->product->firstMedia)
                                         <img src="{{ asset('images/products/' . $product->product->firstMedia->file_name) }}" alt="{{$product->product->name}}"
                                            style=" border-radius: 10px; padding:20px; right:0;">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="" class="img-fluid w-100"
                                             style="border-radius: 10px; padding:20px;right:0; ">
                                    @endif
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-7">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="#" class="mtext-102 cl2 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{$product->product->name}}
                                        </a>

                                        <span class="mtext-102 cl1 ">
                                            {{$code}} {{$product->product->price}}
                                        </span>
                                    </div>
                                </div>

                                    <a  href="{{route('product.details', ['id' => $product->product->id, 'slug' => $product->product->slug])}}"  class="btn bg1 cl0  position-btn">
                                        {{trans('custom.product_details')}}
                                    </a>
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
</section>



@stop
