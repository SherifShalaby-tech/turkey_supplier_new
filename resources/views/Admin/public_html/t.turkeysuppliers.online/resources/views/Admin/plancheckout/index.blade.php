@extends('Admin.layouts.master')
@section('title', __('plancheckout.plancheckout'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('plancheckout.plancheckout') }}</h3>
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
                                <h4 class="card-title">{{ __('plancheckout.allplancheckout') }}</h4>
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
                                                    <th>{{ __('plancheckout.company') }}</th>
                                                    <th>{{ __('plancheckout.plan') }}</th>
                                                    <th>{{ __('plancheckout.status') }}</th>
                                                    <th>{{ __('plancheckout.oldprice') }}</th>
                                                    <th>{{ __('plancheckout.newprice') }}</th>
                                                    <th>{{ __('plancheckout.total') }}</th>
                                                    <th>{{ __('plancheckout.ipan') }}</th>
                                                    <th>{{ __('plancheckout.idnum') }}</th>
                                                    <th>{{ __('plancheckout.created_at') }}</th>
                                                    <th>{{ __('admins.transactions') }}</th>
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
            url: '{{ route('admin.plancheckouts.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            {data: 'company', name: 'company', sortable: true},
            {data: 'plan', name: 'plan', sortable: true},
            {data: 'status', name: 'status'},
            {data: 'oldprice', name: 'oldprice',width: '10%'},
            {data: 'newprice', name: 'newprice',width: '10%'},
            {data: 'total', name: 'total',width: '10%'},
            {data: 'ipan', name: 'ipan', sortable: true,width: '10%'},
            {data: 'idnum', name: 'idnum', sortable: true,width: '10%'},
            {data: 'created_at', name: 'created_at', sortable: true},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
        ],
        order: [[9, 'desc']],
    });
</script>
@endpush
