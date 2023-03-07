@extends('layouts.website.master')
@section('title',trans('custom.membership'))
@section('css')
<style>
    .u-center-text {
        text-align: center !important;
    }

    .u-margin-bottom-small {
        margin-bottom: 1.5rem !important;
    }

    .u-margin-bottom-medium {
        margin-bottom: 4rem !important;
    }

    .u-margin-top-big {
        margin-top: 5rem !important;
    }
    .heading-primary {
        color: #fff;
        text-transform: uppercase;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        margin-bottom: 6rem;
    }

    .heading-primary--main {
        display: block;
        font-size: 24px;
        font-weight: 400;
        letter-spacing: 3.5rem;
        -webkit-animation-name: moveInLeft;
        animation-name: moveInLeft;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
        /*
              animation-delay: 3s;
              animation-iteration-count: 3;
              */
    }

    .heading-primary--sub {
        display: block;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 1.75rem;
        -webkit-animation: moveInRight 1s ease-out;
        animation: moveInRight 1s ease-out;
    }

    .heading-secondary {
        /*font-size: 3.5rem;*/
        text-transform: uppercase;
        font-weight: 100;
        color: transparent;
        letter-spacing: 0.7px;
        line-height: 1;
        -webkit-transition: all 0.2s;
        transition: all 0.2s;
        color: #333;
    }



    *,
    *::after,
    *::before {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: inherit;
        box-sizing: inherit;
    }

    /*html {*/
    /*    font-size: 62.5%;*/
    /*}*/

    body {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .section-plans {
        background-color: rgb(255, 255, 255);
        padding: 4rem 0 4rem 0;
        color: #000;
    }

    .card {
        -webkit-perspective: 150rem;
        perspective: 150rem;
        -moz-perspective: 150rem;
        position: relative;
        height: 55rem;
        border-radius: 10px;
    }

    .card__side {
        height: 55rem;
        -webkit-transition: all 0.8s ease;
        transition: all 0.8s ease;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        border-radius: 3px;
        overflow: hidden;
        -webkit-box-shadow: 0 1.5rem 4rem rgba(0, 0, 0, 0.15);
        box-shadow: 0 1.5rem 4rem rgba(0, 0, 0, 0.15);
        border-radius: 10px;
    }

    .card__side--front {
        background-color: #FFF;
    }

    .card__side--front-1 {

        background: rgb(155,226,235);
        background: linear-gradient(135deg, rgba(155,226,235,1) 0%, rgba(46,178,195,1) 100%);

    }

    .card__side--front-2 {
        background: linear-gradient(-45deg, #f38e21, #ffec61);
    }

    .card__side--front-3 {

        background: rgb(50,175,210);
        background: linear-gradient(135deg, rgba(50,175,210,1) 0%, rgba(3,91,116,1) 100%);
    }

    .card__side--front-4 {
        background: rgb(155,226,235);
        background: linear-gradient(135deg, rgba(155,226,235,1) 0%, rgba(46,178,195,1) 100%);
    }

    .card__side--front-5 {
        background: linear-gradient(-45deg, #f38e21, #ffec61);
    }

    .card__side--front-6 {
        background: rgb(50,175,210);
        background: linear-gradient(135deg, rgba(50,175,210,1) 0%, rgba(3,91,116,1) 100%);
    }

    .card__side--front-7 {
        background: rgb(155,226,235);
        background: linear-gradient(135deg, rgba(155,226,235,1) 0%, rgba(46,178,195,1) 100%);
    }

    .card__side--front-8 {
        background: linear-gradient(-45deg, #f38e21, #ffec61);
    }

    .card__side--front-9 {
        background: rgb(50,175,210);
        background: linear-gradient(135deg, rgba(50,175,210,1) 0%, rgba(3,91,116,1) 100%);
    }

    /*

    .card__side--back-1 {
        background: linear-gradient(-45deg, #64b5f6, #f403d1);
    }

    .card__side--back-2 {
        background: linear-gradient(-45deg, #ffec61, #f3c421);
    }

    .card__side--back-3 {
        background: linear-gradient(-45deg, #9a4eff, #24ff72);
    }
    /* ========== comment this style if u don't need filp card  ===========
    .card__side--back {
        -webkit-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }
    .card:hover .card__side--front-1,
    .card:hover .card__side--front-2,
    .card:hover .card__side--front-3 {
        -webkit-transform: rotateY(-180deg);
        transform: rotateY(-180deg);
    }

    .card:hover .card__side--back {
        -webkit-transform: rotateY(0);
        transform: rotateY(0);
    }*/
    /*  ============================ */
    .card__title {
        font-size: 26px;
        height: 20rem;
        padding: 4rem 2rem 2rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .card__title--1 .fas {
        font-size: 24px;
    }

    .card__title--2 .fas {
        font-size: 24px;
    }

    .card__title--3 .fas {
        font-size: 24px;
    }

    .card__heading {
        /*font-size: 4rem;*/
        font-weight: 300;
        text-transform: uppercase;
        text-align: center;
        color: #000;
        width: 75%;
    }

    .card__heading-span {
        padding: 1rem 1.5rem;
        -webkit-box-decoration-break: clone;
        box-decoration-break: clone;
    }

    .card__details {
        padding: 0 2rem 2rem;
        font-size: 24px;
        font-weight: 100;
    }

    .card__details ul {
        list-style: none;
        width: 80%;
        margin: 0 auto;
        color: #000;
    }

    .card__details ul li {
        text-align: center;
        /*font-size: 1.5rem;*/
        padding: 1rem;
    }

    .card__details ul li:not(:last-child) {
        border-bottom: 1px solid #000;
    }

    .card__cta {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 90%;
        text-align: center;
    }

    .card__price-box {
        text-align: center;
        color: #000;
        margin-bottom: 8rem;
    }

    .card__price-only {
        font-size:24px;
        text-transform: uppercase;
    }

    .card__price-value {
        font-size:24px;
        font-weight: 100;
    }

    .card__side h4{
        font-weight: 400;
    }

    footer ul {
        padding-left: 40px;
    }
</style>


@stop
@section('content')
    <div class="membership text-center p-5">
        <div class="container-fluid">
            <div class="u-center-text u-margin-bottom-big">
                <h2 class="heading-secondary mb-5">
                    {{trans('custom.membership')}}
                </h2>
            </div>
            <div class="row">
                @if($plans->count() > 0)
                    @foreach($plans as $plan)
                        <div class="col-1-of-3 col-lg-4 col-sm-12 col-md-6 mb-3 wobble-horizontal">
                            <a href="{{route('planPayment')}}">
                                <div class="card">
                                <div class="card__side card__side--front-{{$plan->id}}">

                                    <div class="card__title card__title--2">
{{--                                        <i class="fas fa-paper-plane"></i>--}}
                                        <h2 class="card__heading">{{$plan->title}}</h2>
                                        <h3 class="card__heading">{{$plan->price}}$</h3>
                                    </div>

                                    <div class="card__details">
                                        <ul>
                                            <li>  {{$plan->character_count ?? '-'}} {{trans('plans.character_count')}}</li>
                                            <li>  {{$plan->company_picture_count ?? '-'}} {{trans('plans.company_picture_count')}}</li>
                                            <li>  {{$plan->product_count ?? '-'}} {{trans('plans.product_count')}}</li>
                                            <li>  {{$plan->product_picture_count ?? '-'}} {{trans('plans.product_picture_count')}}</li>
{{--                                            <li>  {{$plan->video_time ?? '-'}} {{trans('plans.video_time')}}</li>--}}
                                            <li>  {{$plan->video_count ?? '-'}} {{trans('plans.video_count')}}</li>
                                            <li>  {{$plan->speacial_customer ?? '-'}} {{trans('plans.speacial_customer')}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ========== comment this div if u don't need filp card  =========== -->
                                <!--
                                <div class="card__side card__side--back card__side--back-2">
                                    <div class="card__cta">
                                        <div class="card__price-box">
                                            <p class="card__price-only">{{$plan->title}}</p>
                                            <p class="card__price-value">${{$plan->price}}</p>
                                        </div>
{{--                                        <a href="#popup" class="btn btn--white">Select</a>--}}
                                    </div>
                                </div>
                            -->
                                <!-- =================== -->
                            </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="p-5 alert alert-danger">
                        <p class="text-danger">Plans not found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>


@stop
