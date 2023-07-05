@extends('Admin.layouts.master')
@section('title',__('service.service'))
@section('css')
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('service.service') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.home') }}</a>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        {{-- @if (auth()->user()->hasPermission('create_admins')) --}}
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm mb-3"> {{ __('service.newservice') }}</a>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{trans('service.allservices')}}</h4>
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
                                                <th>{{trans('service.created_date')}}</th>
                                                <th>{{trans('service.actions')}}</th>
                                            </tr>
                                            </thead>

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
@endsection

@push('js')

    <script>
        let countriesTable = $('#service-table').DataTable({
            // dom: 'Blfrtip',
            serverSide: true,
            processing: true,
            lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
            "language": {
                "url": "{{ asset('dashboard/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.services.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},

                {data: 'name', name: 'name', searchable: true, sortable: false},
                // {data: 'type', name: 'type',width: '10%'},
                // {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at', sortable: true},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[2, 'desc']],
        });
    </script>

@endpush
