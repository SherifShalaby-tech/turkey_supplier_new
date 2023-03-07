@extends('layouts.website.master')
@section('title','products')
@section('content')
<style>
    .card-body{
        padding: 0 !important;
    }
    @media (max-width:1440px) {
        .shipping .card img{
            height: 288px !important;
        }
        .card-title-name{
            padding: 0 10px;
            width:270px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
        .card-title {
            font-size: 24px !important;
            letter-spacing: 1px;
        }
        .stext-105{
            font-size: 24px;
        }
    }
    @media (max-width:1400px) {
        .shipping .card img{
            height: 278px !important;
        }
    }
    @media (max-width:1024px) {
        .shipping .card img{
            height: 224px !important;
        }
        .card-title-name{
            padding: 0 10px;
            width:210px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
        .card-title {
            font-size: 24px !important;
            letter-spacing: 1px;
        }
        .stext-105{
            font-size: 24px;
        }
    }
    @media (max-width:768px) {
        .shipping .card img{
            height: 350px !important;
        }
        .card-title-name{
            padding: 0 10px;
            width:330px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
        .card-title {
            font-size: 24px !important;
            letter-spacing: 1px;
        }
        .stext-105{
            font-size: 24px;
        }
    }
    @media (max-width:425px) {
        .shipping .card img{
            height:180px !important;
        }
        .card-title {
            font-size: 20px !important;
            letter-spacing: 1px;
        }
        .card-title-name{
            padding: 0 4px;
            width:180px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
    }
    @media (max-width:375px) {
        .shipping .card img{
            height:155px !important;
        }
        .card-title {
            font-size: 20px !important;
            letter-spacing: 1px;
        }

        .stext-105{
            font-size: 18px;
        }
            .card-title-name{
            padding: 0 4px;
            width:150px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
    }
</style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb stext-105 ">
            <li class="breadcrumb-item"><a href="#">{{ Request::segment(2) == 'categories' ? trans('custom.categories'): trans('custom.categories')}}</a></li>
            <li class="breadcrumb-item"><a href="#">{{ Request::segment(4) == 'subcategories' ? trans('custom.sub_categories'): trans('custom.sub_categories')}}</a></li>
{{--            <li class="breadcrumb-item active" aria-current="page">Data</li>--}}
        </ol>
    </nav>
    <div class="shipping text-center mt-3 p-5">
        <div class="container-fluid">
            <h3 class="mb-4">{{trans('custom.sub_categories')}}</h3>
            <div class="row">
                {{-- @if($category->products->count() > 0) --}}
                @if(isset($category->subCategories))
                    @forelse($category->subCategories as $sub_cat)
                        <div class="mb-3 col-sm-12 col-md-6 col-lg-3 col-6">
                            <div class="card" style="width:100%; padding-bottom: 10px; height: auto;">
                                <a href="{{route('subcategory.products',$sub_cat->id)}}">
                                            @if($sub_cat->image)
                                                <img src="{{asset('images/sub_categories/' . $sub_cat->image)}}" class="img-fluid w-100"
                                                    style="max-width: 100%; height:380px; width: 100% !important;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: 50% 50%;
                                                border-radius: 7px;" >
                                            @else
                                             <img src="{{asset('images/no-image.png')}}" class="img-fluid w-100"
                                                  style="max-width: 100%; height:380px; width: 100% !important;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: 50% 50%;
                                                border-radius: 7px;" >
                                            @endif
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title card-title-name">{{$sub_cat->name ?? null}}</h4>
                                        <a href="{{route('subcategory.products',$sub_cat->id)}}" class="btn bg9 cl0 hov-cl0 stext-105 " >{{trans('custom.all_products')}}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="error-not-found">
                                <div class="not-found-msg">
                                    <p class="alert alert-danger stext-105 ">{{trans('custom.products_not_found')}}</p>
                                </div>
                            </div>
                        @endforelse
                        @else
                            <div class="error-not-found">
                                <div class="not-found-msg">
                                    <p class="alert alert-danger stext-105 ">{{trans('custom.products_not_found2')}}</p>
                                </div>
                            </div>
                        @endif
            </div>
        </div>
    </div>


@stop
