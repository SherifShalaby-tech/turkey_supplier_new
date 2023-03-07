@extends('layouts.website.master')
@section('title',trans('custom.timeline'))
@section('css')
<style>
    .blue-bg {
        background-color: #ffffff;
        color: #ED8D8D;
        height: 100%;
        font-size: 22px;
    }

    .circle {
        font-weight: bold;
        padding: 15px 20px;
        border-radius: 50%;
        background-color: #ED8D8D;
        color: #4D4545;
        max-height: 50px;
        z-index: 2;
    }

    .how-it-works.row {
        display: flex;
    }
    .how-it-works.row .col-2 {
        display: inline-flex;
        align-self: stretch;
        align-items: center;
        justify-content: center;
    }
    .how-it-works.row .col-2::after {
        content: "";
        position: absolute;
        border-left: 3px solid #ED8D8D;
        z-index: 1;
    }
    .how-it-works.row .col-2.bottom::after {
        height: 50%;
        left: 50%;
        top: 50%;
    }
    .how-it-works.row .col-2.full::after {
        height: 100%;
        left: calc(50% - 3px);
    }
    .how-it-works.row .col-2.top::after {
        height: 50%;
        left: 50%;
        top: 0;
    }

    .timeline div {
        padding: 0;
        height: 40px;
    }
    .timeline hr {
        border-top: 3px solid #ED8D8D;
        margin: 0;
        top: 17px;
        position: relative;
    }
    .timeline .col-2 {
        display: flex;
        overflow: hidden;
    }
    .timeline .corner {
        border: 3px solid #ED8D8D;
        width: 100%;
        position: relative;
        border-radius: 15px;
    }
    .timeline .top-right {
        left: 50%;
        top: -50%;
    }
    .timeline .left-bottom {
        left: -50%;
        top: calc(50% - 3px);
    }
    .timeline .top-left {
        left: -50%;
        top: -50%;
    }
    .timeline .right-bottom {
        left: 50%;
        top: calc(50% - 3px);
    }
</style>
@stop
@section('content')
    <!-- partial:index.partial.html -->
    <div class="blue-bg p-5">
        <div class="container-fluid">
            <h2 class="pb-3 pt-2"> Timeline</h2>
                <!--first section-->
                <div class="row align-items-center how-it-works">
                    <div class="col-2 text-center bottom">
                        <div class="circle">{{$order->id}}</div>
                    </div>
                    <div class="col-6">
                        <h5>{{$order->status}}</h5>
                        <p>{{$order->created_at->format('Y-m-d')}}</p>
                    </div>
                </div>
                <!--path between 1-2-->
                <div class="row timeline">
                    <div class="col-2">
                        <div class="corner top-right"></div>
                    </div>
                    <div class="col-8">
                        <hr/>
                    </div>
                    <div class="col-2">
                        <div class="corner left-bottom"></div>
                    </div>
                </div>
        </div>
    </div>
    <!-- partial -->


@stop
