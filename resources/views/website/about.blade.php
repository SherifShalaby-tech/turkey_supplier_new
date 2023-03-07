@extends('layouts.website.master')
@section('title','About Us')
@section('content')
<style>
.about-page p{
    font-weight: 400 !important;font-size: 22px;  font-family: Arial, Helvetica, sans-serif !important;
}
</style>

    <div class="about-page  p-5">
        <div class="container-fluid">
            @forelse($abouts as $key => $about)
            <div class="about mt-3 mb-3">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">

                        {{-- <h4 class="cl7">{{trans('custom.about_us')}}</h4> --}}
                        {{-- <p>{{$data->about_us ?? '-'}}.</p> --}}
                        <pre>
                            <p>{!! $about->subject!!}</p>
                        </pre>
                     

                    </div>
                    <div class="col-lg-4 col-sm-12">
                        @if($about->image)
                        <img src="{{ asset('images/about_us/'.$about->image) }}" alt="" class="img-thumbnail"
                        width="70%" >
                        {{-- {!! $aboutnew->subject !!} --}}
                        @else
                        <img src="{{ asset('images/Logo.jpg') }}" alt="" class="img-thumbnail" width="90%">
                        @endif
                        {{-- <img src="{{asset('website/imgs/product.png')}}" width="70%" class="img-thumbnail"> --}}
                    </div>
                </div>
            </div>
            @empty

            @endforelse

            {{-- <div class="services mb-3">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <h4 class="cl7">{{trans('custom.services')}}</h4>
                        <pre>
                            <p>{{$data->services ?? '-'}}</p>
                        </pre>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <img src="{{asset('images/shipment/air_freight.png')}}" width="70%" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <div class="shipping mb-3">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <h4 class="cl7">{{trans('custom.shipping')}}</h4>
                        <pre>
                            <p>{{$data->shipping_products ?? '-'}}.</p>
                        </pre>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <img src="{{asset('images/shipment/air-freight.png')}}" width="70%" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <div class="mediation mb-3">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <h4 class="cl7">{{trans('custom.Mediation')}}</h4>
                        <pre>
                            <p>{{$data->mediation ?? '-'}}.</p>
                        </pre>           
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <img src="{{asset('images/meditations/74366467144.jpg')}}" width="70%" class="img-thumbnail">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

@stop
