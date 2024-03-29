@extends('Admin.layouts.master')
@section('title',__('custom.shipping_services'))
@section('css')
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('custom.shipping_services') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.home') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{trans('custom.shipping_services')}}</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table class="table table-striped table-bordered zero-configuration" id="service-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('service.name')}}</th>
                                                <th>{{trans('products.description')}}</th>
                                                <th>{{trans('service.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if($shipment->count() > 0)
                                                    @foreach($shipment as $index => $s)
                                                        <tr>
                                                            <th scope="row">{{$index + 1}}</th>
                                                            <td>{{$s->name}}</td>
                                                            <td>{!! $s->basic_shipping_service !!}</td>
                                                            <td>
                                                                <a class="btn btn-primary" href="{{route('admin.shipmentService.edit',$s->id)}}">{{trans('site.edit')}}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


@stop
