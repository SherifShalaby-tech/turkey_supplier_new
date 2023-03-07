@extends('Admin.layouts.master')
@section('title',__('orders.order_details'))
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">

                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('orders.order_details') }}</h3>

                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.home') }}</a>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        {{--                        @if (auth()->user()->hasPermission('create_categories'))--}}
                        {{--                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm mb-3">--}}
                        {{--                                {{ __('categories.newcategory') }}--}}
                        {{--                            </a>--}}
                        {{--                        @endif--}}
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <h4 class="card-title">{{ __('orders.order_details') }}</h4>

                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table class="table table-striped table-bordered zero-configuration" id="orders-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th scope="col">{{trans('orders.product_name')}}</th>
                                                <th scope="col">{{trans('orders.product_image')}}</th>
                                                <th scope="col">{{trans('orders.product_price')}}</th>
                                                <th scope="col">{{trans('orders.product_code')}}</th>
                                                <th scope="col">{{trans('orders.category_name')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($details->count() > 0)
                                                @foreach($details as $key => $detail)
                                                    @foreach($detail->cart->details as $cart)
                                                        <tr>
                                                            <th scope="row">{{$key + 1}}</th>

                                                            <td>{{$cart->product?->name}}</td>
                                                            <td>
                                                                @if($cart->product->firstMedia)
                                                                    <img src="{{asset('images/products/' . $cart->product->firstMedia->file_name)}}" width="100">
                                                                @endif
                                                            </td>
                                                            <td>{{$cart->product?->price}}</td>
                                                            <td>{{$cart->product?->code}}</td>
                                                            <td>{{$cart->product?->category->name}}</td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <div class="alert alert-danger">
                                                    <p>{{trans('custom.orders_not_found')}}</p>
                                                </div>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


@stop
