@extends('layouts.website.master')
@section('title','New Arrivals')
@section('content')
    <!-- banar -->
    <div class="banar mb-5">
        <div class="banar-data">
            <h4>New Arrivals</h4>
            <h4>New Releases</h4>
            <h4>Trending Now</h4>
        </div>
        <div class="container-fluids">
            <img src="{{asset('website/imgs/Mask group.png')}}" class="img-fluid">
        </div>
    </div>
    <!-- end of banar -->
    <!-- Swiper best-sellers -->
    <div class="container">
        <div class="swiper mySwiper offers">
            <div class="offers-data">
                <p>From 50% off</p>
            </div>
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{asset('website/imgs/best_sellers/Rectangle 11.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/best_sellers/Rectangle 16.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/best_sellers/Rectangle 15.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/best_sellers/Rectangle 14.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/best_sellers/Rectangle 13.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/best_sellers/Rectangle 12.png')}}"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Swiper New arrivals -->
    <div class="container">
        <div class="swiper mySwiper trending">
            <div class="trending-data">
                <p>Trending smart home appliances</p>
            </div>
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{asset('website/imgs/new-arrivals/Rectangle 11.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/new-arrivals/Rectangle 13.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/new-arrivals/Rectangle 14.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/new-arrivals/Rectangle 15.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/new-arrivals/Rectangle 16.png')}}"></div>
                <div class="swiper-slide"><img src="{{asset('website/imgs/new-arrivals/Rectangle 67.png')}}"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- new arrivals section -->
    <div class="new-arrival-section">
        <div class="container">
            <p>New Arrivals</p>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @isset($categories)
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab_{{$category->id}}" data-toggle="tab" href="#cat_{{$category->id}}" role="tab" aria-controls="home" aria-selected="true">{{$category->name}}</a>
                        </li>
                    @endforeach
                @endisset
            </ul>
            <div class="tab-content" id="myTabContent">
                @foreach($categories as $category)
                    <div class="tab-pane fade show active" id="cat_{{$category->id}}" role="tabpanel" aria-labelledby="home-tab_{{$category->id}}">
                        <div class="row">
                            @foreach($category->products as $product)
                                <div class="col-md-3 col-12-sm">
                                    <div class="card">
                                    <img class="card-img-top" src="{{asset('website/imgs/new-arrivals/section/Rectangle 11.png')}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product->name}} </h5>
                                        <p class="card-text">excavator with competitive</p>
                                        <a href="#" class="card-text">$7800 - $8000</a>
                                        <p>1 set (MOQ)</p>
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end of new arrivals section-->


@stop
