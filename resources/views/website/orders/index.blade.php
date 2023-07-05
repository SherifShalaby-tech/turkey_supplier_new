@extends('layouts.website.master')
@section('title',trans('custom.orders'))
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#">{{trans('custom.orders')}} </a>
        </p>
    </div>
</div>


<form class="bg0 p-t-75 p-b-85"  >
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-11 col-xl-11 m-lr-auto m-b-50">
                <div class=" m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1"># No.</th>
                                <th class="column-2"> {{trans('custom.order_date')}}</th>
                                <th class="column-4">{{trans('custom.order_status')}}</th>
                                <th class="column-4">{{trans('custom.payment_status')}}</th>
                                <th class="column-5">{{trans('custom.total_price')}}</th>
                                <th class="column-5">{{trans('custom.order_details')}}</th>
                            </tr>

                            @if($orders->count() > 0)
                            @foreach($orders as $key => $order)

                                <tr class="table_row">
                                    <td class="column-1"> {{$key + 1}} </td>
                                    <td class="column-2"> {{$order->created_at->format('Y-m-d')}} </td>
                                    <td class="column-4"> {{$order->status}}</td>
                                    <td class="column-4 ">{{$order->payment_statut}}</td>
                                    <td class="column-5">{{$order->total_price}}</td>
                                    <td class="column-5">
                                        <a href="{{route('order.details',$order->id)}}" class="btn bg9 cl0 hov-cl0">{{trans('custom.order_details')}}</a>
                                        <a href="{{route('getTimelineOrders',$order->order_number)}}" class="btn bg9 cl0 hov-cl0">{{trans('custom.timeline')}}</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <div class="alert alert-danger">
                                        <p> <span class="material-icons">error</span> {{trans('custom.orders_not_found')}}</p>
                                    </div>
                                @endif
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</form>
    






@stop
