@extends('layouts.website.master')
@section('title',trans('custom.you_may_like'))
@section('content')
<style>
    .card-title-name{
        width: 255px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0 !important;
        font-size: 24px ;
    }

    @media (max-width:1440px) {
        .isotope-grid  .trend-img {
            height:370px !important;
            padding: 10px !important;
        }
        .isotope-grid  .trend-img img{
            height:270px !important;
        }
    }
    @media (max-width:1400px) {
        .isotope-grid  .trend-img {
            height:370px !important;
            padding: 10px !important;
        }
        .isotope-grid  .trend-img img{
            height:260px !important;
        }
    }
    @media (max-width:1024px) {
        .isotope-grid  .trend-img {
            height:310px !important;
            padding: 7px !important;
        }
        .isotope-grid  .trend-img img{
            height:212px !important;
        }
    }
    @media (max-width:425px) {
        .isotope-grid  .trend-img {
            height:270px !important;
            padding: 4px !important;
        }
        .isotope-grid  .trend-img img{
            height:174px !important;
        }
    }
</style>
    <section class="bg0 p-t-23 p-b-140 p-5">

        <div class="container-fluid">
            <div class="row isotope-grid">
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 col-6 p-b-35 isotope-item women">
                            <div class="block2 effect8 trend-img"  style=" width: 100%;  height: 450px; padding:10px 20px 0 20px;
                            filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                <div class="block2-pic hov-img0">
                                    <a href="{{route('product.details',$product->slug)}}">
                                        @if($product->firstMedia)
                                            <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                 style="max-width: 100%;  height: 350px ;width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        border-radius: 7px;" >
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid w-100" 
                                            style="max-width: 100%;  height: 350px ;width: 100% !important;
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: 50% 50%;
                                            border-radius: 7px;" >
                                        @endif
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{route('product.details',$product->slug)}}" class="card-title-name stext-104 cl7 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$product->name}}
                                        </a>
                                        <span class="stext-105 cl7">
                                        ${{$product->price}}
                                    </span>
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
            <div class="col-12">
                {{$products->onEachSide(0)->links()}}
            </div>
          
        </div>

    </section>


@stop
