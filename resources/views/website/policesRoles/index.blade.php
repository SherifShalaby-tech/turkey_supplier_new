@extends('layouts.website.master')
@section('title',trans('custom.Policies_Rules'))
@section('content')


<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.Policies_Rules')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-5 p-b-120">
    <div class="container-fluid">

            <div class="row p-b-10 p-t-0">
                <div class="col-12 col-md-12 col-lg-12 m-lr-auto">

                        <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                                <div class="hov-img0 txt-center">

                                    <img class="circle-img txt-center"  src="{{ asset('website/imgs/Group.png') }}" alt="about-img"
                                        style="max-width: 100%;  height: auto; width: 50% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        padding: 20px;">

                                        <p class="cl11 mtext-114 p-b-20">TURKEYSUPPLIERS.ONLINE</p>
                                </div>                
                        </div>
                 
       
                </div>
            </div>  

                <div class="p-b-10 separator">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.Policies_Rules')}}
                        </h3>
                    </div>
                </div>

            <div class="row p-b-0">
                @if($rules->count() > 0)
                    @foreach($rules as $rule)
                    <div class="col-md-12 col-lg-12 txt-start m-t-40 ">
                        <div class="p-tb-20 p-r-85 p-l-85 p-r-15-lg p-lr-10-md  m-r-20 m-l-20 bg2 bor2 box-shadow-0-10-10">

                                    <p class="mtext-101 cl2 p-tb-20 btn-red p-lr-70  m-t-20 m-b-20 ">
                                        {{$rule->title}}
                                    </p>
                                    <p class="mtext-101 cl2 p-b-20">
                                        {!! $rule->description !!}
                                    </p>
                        </div>
                    </div>

                    @endforeach
                @else
                    <div class="col-md-12 col-lg-12 txt-start m-t-40 txt-center ">
                        <div class=" alert alert-danger txt-center">
                            <p class="text-danger mtext-101">not found</p>
                        </div>
                    </div>
                 @endif
            </div>  
        
    </div>
</section>	



@stop
