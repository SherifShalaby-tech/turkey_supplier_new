@extends('layouts.website.master')
@section('title',trans('custom.order_details'))
@section('content')
<style>
    table{
        font-size: 22px;
    }
    table tr{
        font-size: 22px;
        letter-spacing: 1.5px;
    }
    .btn{
        font-size: 20px !important;
    }
</style>
    <div class="orders p-5">
        <div class="container-fluid">
            <h2 class="text-center mt-3 mb-3">{{trans('custom.order_details')}}</h2>
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{trans('custom.product_name')}}</th>
                            <th scope="col">{{trans('custom.product_image')}}</th>
                            <th scope="col">{{trans('custom.product_price')}}</th>
                            <th scope="col">{{trans('custom.product_code')}}</th>
                            <th scope="col">{{trans('custom.category_name')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($details->count() > 0)
                            @foreach($details as $key => $detail)
                                @foreach($detail->cart->details as $cart)
                                    <tr>
                                        <th scope="row">{{$key + 1}}</th>
                                        <td>{{$cart->product->name}}</td>
                                        <td>
                                            @if($cart->product->firstMedia)
                                                <div class="item ">
                                                    <img class="@if (app()->getLocale() == 'ar')  img-ar @endif"
                                                         src="{{ asset('images/products/'.$cart->product->firstMedia->file_name) }}" alt="{{ $cart->product->name }}" class="img-fluid w-100"
                                                         style="max-width: 100%;  height: 300px !important;width: 100% !important;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: 50% 50%;
                                    border-radius: 10px;
                                    " >
                                                </div>
                                            @else
                                                <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $cart->product->name }}" class="img-fluid w-100" >
                                            @endif
                                        </td>
                                        <td>{{$cart->product->price}}</td>
                                        <td>{{$cart->product->code}}</td>
                                        <td>{{$cart->product->category->name}}</td>
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



@stop
