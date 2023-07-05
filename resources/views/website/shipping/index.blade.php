@extends('layouts.website.master')
@section('title','shipping')
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#">{{trans('custom.shipping')}} </a>
        </p>
    </div>
</div>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
            <div class="p-b-10 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.basic_shipping_services')}}
                    </h3>
                </div>
            </div>
        <div class="container">
			<div class="row isotope-grid p-t-20">

                @isset($shipping_services)
                    @foreach($shipping_services as $shipping)
                        <div class="col-sm-6 col-md-4 col-lg-4 p-b-35 isotope-item women  txt-center ">
                            <div class="col-12"  style="box-shadow: rgb(144, 144, 144) 0px 5px 10px;">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <a href="{{route('shipping.details',$shipping->id)}}">
                                            <img src="{{asset('images/shipment/' . $shipping->image)}}" alt="IMG-PRODUCT"
                                            style="left: 0">
                                        </a>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14 txt-center flex-c-m">
                                        <div class="flex-col-c  txt-center">
                                            <a href="{{route('shipping.details',$shipping->id)}}" class="btn btn-red mtext-1075 cl0 hov-cl0 trans-04 js-name-b2 p-lr-30 p-b-12">
                                                 {{$shipping->name}} 
                                            </a>

                                            <span class="mtext-107 cl2 m-t-20">
                                                {!! \Illuminate\Support\Str::limit($shipping->basic_shipping_service,100) !!}
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                <a  href="{{route('shipping.details',$shipping->id)}}" class="btn mtext-1035 cl0 bg1 p-lr-40 hov-cl0" 
                                    style="position: relative; top: 16px;">Read More</a>
                            </div>
                        </div>
                    @endforeach
                @endisset

			</div>
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45 ">
				<a href="{{route('shipping.details',$shipping->id)}}" class=" mtext-1035 cl1 btn bg-btn1">
					Request Quotation
				</a>
			</div>
		</div>
	</section>
@stop
