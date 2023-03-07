@extends('layouts.website.master')
@section('title',$shipping->name)
@section('content')

<style>
    .btn-3{
        background-color: #3797b1;
        color: #fff;
    }
    .inquiries_and_quotes {
        font-size: 24px;
    }
    .inquiries_and_quotes input,select {
                font-family: arial !important;
                font-weight: 600 !important;
                font-size: 20px !important;
            }
    .inquiries_and_quotes textarea {
        font-family: arial !important;
        font-weight: 600 !important;
        font-size: 20x !important;

    }
    .inquiries_and_quotes button {
        font-size: 24px !important;
    }

    .inquiries_and_quotes .form-group-ar {
            text-align: right;
        }
        .p-5{
            padding: auto 5%;
        }
</style>
    <div class="air_freight p-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-sm-12">
                    <h2 class="mb-4 mt-3">{{trans('custom.basic_shipping_services')}}</h2>
                   <pre>
                    <p style=" font-weight: 400 !important;;font-size: 22px;  font-family: Arial, Helvetica, sans-serif !important;">{!! $shipping->basic_shipping_service !!}</p>
                   </pre>

                </div>
                <div class="col-lg-5 col-sm-12 mt-5">
                    <img class="img-thumbnail" src="{{asset('website/imgs/shipping/air_freight.png')}}" width="100%">
                </div>
            </div>
            <div class="row" style="display: contents;">
                <button onclick="shippingFun()" class="btn btn-primary" style="color: #fff;background-color: #3797b1; border:none; font-weight: 100;font-size: 24px;">
                    {{trans('custom.request_quotation')}}
                </button>
            </div>
        </div>
    </div>

    <div class="air_freight_form text-center" id="myShippingForm" >
        <livewire:front.shipping-component />
    </div>


    <script>
        function shippingFun() {
        let x = document.getElementById("myShippingForm");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      }
      </script>
@stop
