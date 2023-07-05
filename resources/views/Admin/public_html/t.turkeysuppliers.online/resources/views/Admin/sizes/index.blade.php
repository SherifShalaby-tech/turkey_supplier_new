@extends('Admin.layouts.master')
@section('title',__('sizes.sizes'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{trans('sizes.sizes')}}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('site.home') }}</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    @if (auth()->user()->hasPermission('create_sizes'))
                        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal"
                                data-target="#add">
                            {{ trans('site.add') }}
                        </button>
                    @endif
                    @include('Admin.sizes.btn.add')
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{trans('sizes.allsize')}}</h4>
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
                                    <table class="table table-striped table-bordered " id="sizes-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('sizes.sizeName')}}</th>
                                                <th>{{trans('product.product')}}</th>
                                                <th>{{trans('site.created_at')}}</th>
                                                <th>{{trans('sizes.datatable')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sizes as $size)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $size->sizeName }}</td>
                                                <td>{{ $size->product->name ??null}}</td>
                                                <td>{{ $size->created_at() }}</td>
                                                <td class="d-flex gap-2">
                                                    @include('Admin.sizes.data_table.actions')
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $sizes->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

