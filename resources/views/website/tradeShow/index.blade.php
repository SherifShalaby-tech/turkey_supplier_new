@extends('layouts.website.master')
@section('title',trans('custom.trade_show'))
@section('content')
<style>
        .card-title-name{
        width: 350px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<section class="bg0 p-t-23 p-b-140  text-center p-5">
    <div class="container-fluid">
        <h2 class="mb-3">{{trans('tradeshows.tradeshows')}}</h2>
        <div class="row isotope-grid">
            @if($tradeShow->count() > 0)
            @foreach($tradeShow as $tradeShow)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                            
                                    @if($tradeShow->firstMedia)
                                        <img src="{{ asset('images/tradeShows/'.$tradeShow->firstMedia->file_name) }}" alt="{{ $tradeShow->title }}" class="img-fluid w-100"
                                             style="max-width: 100%;  height: 370px !important;width: 100% !important;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: 50% 50%;
                                    border-radius: 7px;
                                    " >
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="{{ $tradeShow->title }}" class="img-fluid w-100"
                                        style="max-width: 100%;  height: 390px !important;width: 100% !important;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: 50% 50%;
                                        border-radius: 7px;
                                        " >
                                    @endif
                              
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <span class="stext-105 cl7">
                                        <h3 class="card-title card-title-name">{{$tradeShow->title}}</h3>
                                  
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="add-address" style="margin-bottom: 135px">
                    <p class="text-danger alert alert-danger">There are no results !</p>
                </div>
            @endif
        </div>

    </div>
</section>


@stop
