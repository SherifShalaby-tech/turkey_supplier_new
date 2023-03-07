@extends('layouts.website.master')
@section('title',trans('custom.orders'))
@section('content')
<style>
    table{
        font-size: 22px;
    }
    table tr{
        font-size: 22px;
        letter-spacing: 1.5px;
    }
    .btn{
        font-size: 20px !important;
    }
</style>
<div class="orders p-5">
    <div class="container-fluid">
        <h2 class="text-center mt-3 mb-3">{{trans('custom.orders')}}</h2>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{trans('custom.order_date')}}</th>
                        <th scope="col">{{trans('custom.order_status')}}</th>
                        <th scope="col">{{trans('custom.payment_status')}}</th>
                        <th scope="col">{{trans('custom.total_price')}}</th>
                        <th scope="col">{{trans('custom.order_details')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($orders->count() > 0)
                        @foreach($orders as $key => $order)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$order->created_at->format('Y-m-d')}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->payment_statut}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>
                                    <a href="{{route('order.details',$order->id)}}" class="btn bg9 cl0 hov-cl0">{{trans('custom.order_details')}}</a>
                                    <a href="{{route('getTimelineOrders',$order->order_number)}}" class="btn bg9 cl0 hov-cl0">{{trans('custom.timeline')}}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="alert alert-danger">
                            <p>{{trans('custom.orders_not_found')}}</p>
                        </div>
                    @endif
                    </tbody>
                </table>
            </div>
    </div>
</div>
</div>


@stop
