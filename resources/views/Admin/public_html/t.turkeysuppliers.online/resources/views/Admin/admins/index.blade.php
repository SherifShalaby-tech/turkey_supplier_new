@extends('Admin.layouts.master')
@section('title', __('site.admins'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('admins.admins') }}</h3>
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
                    @if (auth()->user()->hasPermission('create_admins'))
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm mb-3"> {{ __('admins.newadmin') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('admins.alladmin') }}</h4>
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
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-sm dtHorizontalExample" id="admins-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('admins.name') }}</th>
                                                    <th>{{ __('admins.email') }}</th>
                                                    <th>{{ __('admins.phone') }}</th>
                                                    {{-- <th>النوع</th> --}}
                                                    <th>{{ __('admins.status') }}</th>
                                                    {{-- <th>{{ __('admins.permissions') }}</th> --}}
                                                    <th>{{ __('admins.created_at') }}</th>
                                                    @if (auth()->user()->hasPermission('update_admins','delete_admins'))
                                                    <th>{{ __('admins.transactions') }}</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
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
    let countriesTable = $('#admins-table').DataTable({
        dom: 'Bfprltip',
        buttons: [
            'excel',
            'pdf',
            {
                extend: 'print',
                text: 'Print selected',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        select: true,
        serverSide: true,
        processing: true,
        Savestate :true,
        scrollX: true,
        scrollY: '70vh',
        scrollCollapse: true,
        pagingType: "full_numbers",
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "language": {
            "url": "{{ asset('dashboard/datatable-lang/' . app()->getLocale() . '.json') }}"
        },
        ajax: {
            url: '{{ route('admin.admins.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            {data: 'name', name: 'name', searchable: true, sortable: true},
            {data: 'email', name: 'email', searchable: true, sortable: false},
            {data: 'phone', name: 'phone', searchable: false, sortable: false},
            // {data: 'type', name: 'type',width: '10%'},
            {data: 'status', name: 'status'},
            // {data: 'roles_name', name: 'roles_name', searchable: false, sortable: false, width: '22%'},
            {data: 'created_at', name: 'created_at', sortable: true},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
        ],
        order: [[5, 'desc']],
    });
</script>
@endpush
