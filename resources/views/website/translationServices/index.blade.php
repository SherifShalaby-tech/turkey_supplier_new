@extends('layouts.website.master')
@section('title',trans('custom.translation_services'))
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.translationServices')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-75 p-b-120">
    <div class="container-fluid">

        @forelse($translationServices as $translationService)
            <div class="row p-b-148">

                <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                    <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                        <div class="  ">
                            <div class="block2-pic hov-img0">
                                @if($translationService->image)
                                    <img src="{{asset('images/translations/'.$translationService->image)}}"  alt="{{ $translationService->name }}"
                                        style="
                                        border-radius: 30px; right:0%;">
                                @else
                                    <img src="{{ asset('images/Logo.jpg') }}" alt="Card image cap"
                                        style="
                                            border-radius: 30px; right:0%;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12 txt-center m-t-40">
                    <div class="p-tb-20 p-r-85 p-l-85 p-r-15-lg p-lr-10-md border-dot m-r-20 m-l-20">
                        <p class="ltext-101 cl2 p-b-26">
                            {!! $translationService->description !!}
                        </p>
                    </div>
                </div>
                @empty
                <div class="col-12 col-md-12 col-lg-12 m-lr-auto txt-center">
                    <p class="mtext-101 text-danger">Translation not found</p>
                </div>
            </div>
        @endforelse

        <div class="col-12 col-md-12 col-lg-12 m-lr-auto txt-center p-t-30 ">
            <a href="{{route('translationServicesRequest')}}" class="btn bg1 cl0 mtext-108">{{trans('custom.translation_services_request')}}</a>
        </div>

    </div>
</section>	



@stop
