@extends('layouts.website.master')
@section('title','shipping')
@section('content')
<style>

    .p-5 {
        padding: 0rem!important;
    }


</style>
    <div class="shipping text-center mt-3 text-center p-5">
        <div class="container-fluid">
            <h2 class="mb-3">{{trans('custom.basic_shipping_services')}}</h2>
            <div class="row" style="padding-left: 5%;">
                @isset($shipping_services)
                    @foreach($shipping_services as $shipping)
                        <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                            <div class="card" style="width:90%;">
                                <a href="{{route('shipping.details',$shipping->id)}}">
                                    <img class="card-img-top" src="{{asset('images/shipment/' . $shipping->image)}}" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title">{{$shipping->name}}</h3>
                                    <p style="font-weight: 400 !important;;font-size: 22px; height: fit-content; font-family: Arial, Helvetica, sans-serif !important; "
                                    class="card-text">{!! \Illuminate\Support\Str::limit($shipping->basic_shipping_service,100) !!}</p>
                                    <a  href="{{route('shipping.details',$shipping->id)}}" class="btn btn-primary"
                                        style="color: #fff;background-color: #3797b1; border:none; font-weight: 100;font-size: 22px;letter-spacing: 1px;">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>

{{--            <div class="row" style="display: contents;">--}}
{{--                <a onclick="shippingFun()" href="{{route('shipping.details',$shipping->id)}}" class="btn btn-primary"--}}
{{--                    style="color: #fff;background-color: #3797b1; border:none; font-weight: 100;font-size: 22px; letter-spacing: 1px;  padding: 7px 50px;">--}}
{{--                    {{trans('custom.request_quotation')}}  </a>--}}
{{--            </div>--}}
        </div>
    </div>

@stop
