@extends('layouts.website.master')
@section('title',trans('custom.Help_Center'))
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.Help_Center')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-75 p-b-120">
    <div class="container-fluid">



            <div class="row p-b-148">
                @if($help_center->count() > 0)
                    @foreach($help_center as $help)
                        <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                            <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                                <div class="txt-center">
                                    <div class="hov-img0">
                                        <img class="circle-img txt-center" src="{{asset('images/helpcenter/' . $help->image)}}" alt="Card image cap"
                                            style="max-width: 100%;  height: auto; width: 60% !important;
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: 50% 50%;
                                            padding: 50px;">
                                            <p class="txt-center cl0 p-t-20 p-b-20 btn-red btn p-lr-70">{{$help->title}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 txt-center m-t-40">
                            <div class="p-tb-20 p-r-85 p-l-85 p-r-15-lg p-lr-10-md  border-dot m-r-20 m-l-20">
                                <p class="ltext-101 cl2 p-b-20">
                                    {!! $help->description !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                        <div class="col-12 col-md-12 col-lg-12 m-lr-auto txt-center">
                            <p class="mtext-101 text-danger">{{trans('custom.not_found')}}</p>
                        </div>
                @endif
            </div>
    </div>
</section>

@stop
