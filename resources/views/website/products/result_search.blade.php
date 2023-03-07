@extends('layouts.website.master')
@section('title','Search')
@section('content')
<section class="bg0 p-t-23 p-b-140">

    <div class="container">
        <div class="row isotope-grid">
            @if($products->count() > 0)
                @foreach($products as $product)
                   <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <a href="{{route('product.details',$product->slug)}}">
                                    @if($product->firstMedia)
                                        <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                            style="max-width: 100%;  height: 255px !important;width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        border-radius: 7px;
                                        " >
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                    @endif
                                </a>
                             </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{route('product.details',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$product->name}}
                                    </a>
                                    <span class="stext-105 cl3">
                                        ${{$product->price}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($companies->count() > 0)
                @foreach($companies as $company)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <a href="{{route('supplier.profile',$company->id)}}">
                                    @if($company->firstMedia)
                                        <img src="{{ asset('images/companies/'.$company->firstMedia->file_name) }}" alt="{{ $company->name }}" class="img-fluid w-100"
                                             style="max-width: 100%;  height: 255px !important;width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        border-radius: 7px;
                                        " >
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="{{ $company->name }}" class="img-fluid w-100" >
                                    @endif
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{route('supplier.profile',$company->id)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$company->name}}
                                    </a>
                                    <span class="stext-105 cl3">
                                    {{$company->phone}}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($categories->count() > 0)
                @foreach($categories as $category)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <a href="#">
                                    @if($category->image)
                                        <img src="{{ asset('images/categories/'.$category->image) }}" alt="{{ $category->name }}" class="img-fluid w-100"
                                             style="max-width: 100%;  height: 255px !important;width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        border-radius: 7px;
                                        " >
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="{{ $category->name }}" class="img-fluid w-100" >
                                    @endif
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$category->name}}
                                    </a>
                                    {{--                                        <span class="stext-105 cl3">--}}
                                    {{--                                        ${{$product->price}}--}}
                                    {{--                                    </span>--}}
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
        </div>
    </div>

</section>


@stop
