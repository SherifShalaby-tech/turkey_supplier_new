@extends('layouts.website.master')
@section('title','Cart')
@section('content')

<div class="cart p-5 mt-3">
    <div class="container-fluid">
        <form action="{{route('cart.confirm.cart')}}" method="POST">
            @csrf
            <div class="row">
            <div class="col-lg-9 col-sm-12">
                    @if(isset($details))
                        @foreach($details as $key => $de)
                            <!-- hidden inputs -->
                                <input type="hidden" name="cart_id" value="{{$de->cart_id}}">
                                <input type="hidden" name="user_id" value="{{$cart->company_id}}">
                                <input type="hidden" name="products[{{$key}}][product_id]" value="{{$de->product->id}}">
                            <div class="card">
                                <h5 class="card-header"></h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6">
                                            @if($de->product->firstMedia)
                                                    <img src="{{ asset('images/products/'.$de->product->firstMedia->file_name) }}" alt="{{ $de->product->name }}" class="img-fluid w-100"
                                                         style="max-width: 100%;  height: 200px !important;width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    border-radius: 10px;">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" alt="{{ $de->product->name }}" class="img-fluid w-100"
                                                    style="max-width: 100%;  height: 200px !important;width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    border-radius: 10px;">
                                                @endif
                                        </div>
                                        <div class="col-lg-9 col-sm-6" style="position:relative;">
                                            <h5 class="card-title">{{$de->product->name}}</h5>
{{--                                            <p class="card-text">{!! $de->product->description !!}</p>--}}
                                            <div style="position: absolute;right: 24px" class="@if(app()->getLocale() == 'ar')price-ar @endif">
                                                <span>{{trans('custom.price')}}</span>
                                                <p>${{$de->product->price}}</p>
                                            </div>
                                            <div class="cart_product_actions">
                                                <div class="form-group" style="display: inline-block">
                                                    <input type="number" value="1" class="form-control" name="products[{{$key}}][qty]">
                                                </div>
                                                <a href="{{route('cart.product.delete',[$de->product->id,$de->cart_id])}}">Delete</a>
                                                <form style="display:inline-block;" action="{{route('cart.save.product',[$de->product->slug,$de->cart_id])}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$de->product->id}}">
                                                    <input type="hidden" name="cart_id" value="{{$de->cart_id}}">
                                                    <button class="save" type="submit">Save for later</button>
                                                </form>
                                            </div>
                                            <hr style="border-color: black">
                                            <p>Subtotal (1 item): ${{$de->product->price}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="add-address">
                            <p>{{trans('custom.Your_Cart_is_empty')}}</p>
                            <a href="{{route('website.index')}}">{{trans('custom.Continue_shopping')}}</a>
                        </div>
                    @endif
            </div>
            @if(isset($details))
                <div class="col-lg-3 col-sm-12">
                    <div class="text-center add_order">
                        <p>{{trans('custom.Your_order_qualifies_for_FREE_Shipping_Choose_this_option_at_checkout')}}. <a href="#">{{trans('custom.see_details')}}</a></p>
                        <p>Subtotal (1 item):  <b>$8,0000</b></p>
                        <button type="submit" style="color: #fff; font-size:22px">{{trans('custom.Proceed_to_Buy')}}</button>


                    </div>
                </div>
            @endif
            </div>
        </form>
    </div>
</div>

@stop
