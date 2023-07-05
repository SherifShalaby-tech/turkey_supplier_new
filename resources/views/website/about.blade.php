@extends('layouts.website.master')
@section('title','About Us')
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.about_us')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-5 p-b-120">
    <div class="container-fluid">

       
            <div class="row p-b-10 p-t-0">
                <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                    @forelse($abouts as $key => $about)
                    <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                            <div class="hov-img0 txt-center">
                                @if($about->image)
                                    <img class="circle-img txt-center"  src="{{ asset('images/about_us/'.$about->image) }}" alt="about-img"
                                        style="max-width: 100%;  height: auto; width: 60% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        padding: 50px;">
                              
                                @else
                                    <img class="circle-img txt-center" src="{{ asset('images/Logo.jpg') }}" alt="about-img" 
                                    style="max-width: 100%;  height: auto; width: 60% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        padding: 50px;">
                                @endif
                            </div>                
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>  

                <div class="p-b-10 separator">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.about_us')}}
                        </h3>
                    </div>
                </div>

            <div class="row p-b-0">
                <div class="col-md-12 col-lg-12 txt-start m-t-40 ">
                    <div class="p-t-20 p-r-85 p-l-85 p-r-15-lg p-r-0-md p-l-0-md  m-r-20 m-l-20 bg2 bor2 box-shadow-0-10-10">
                        @forelse($abouts as $key => $about)
                      
                                <p class="mtext-101 cl2 p-b-26">
                                    {!! $about->subject!!}
                                </p>
                         
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>  
        
    </div>
</section>	


@stop
