@extends('Admin.layouts.master')
@section('title', __('site.clerks'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('clerks.clerks') }}</h3>
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
                    <a href="{{ route('admin.clerks.create') }}" class="btn btn-primary btn-sm mb-3"> {{ __('clerks.newclerk') }}</a>
                    {{-- @endif --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')" >
                </div>
            </div>
        </div>
        <div class="content-body">
            <section >
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('clerks.allclerk') }}</h4>
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
                                        <table class="table table-striped table-bordered table-sm " id="clerks-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('clerks.name') }}</th>
                                                    <th>{{ __('clerks.email') }}</th>
                                                    <th>{{ __('clerks.phone') }}</th>
                                                    <th>{{ __('clerks.company') }}</th>
                                                    <th>{{ __('clerks.status') }}</th>
                                                    <th>{{ __('clerks.created_at') }}</th>
                                                    <th>{{ __('clerks.transactions') }}</th>
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
    let clerksTable = $('#clerks-table').DataTable({
        dom: 'Bprltip',
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
            url: '{{ route('admin.clerks.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            {data: 'name', name: 'name', searchable: true, sortable: true,orderable: true, width: '15%'},
            {data: 'email', name: 'email', searchable: true, sortable: true,orderable: true, width: '10%'},
            {data: 'phone', name: 'phone', searchable: true, sortable: true,orderable: true, width: '10%'},
            {data: 'company', name: 'company', searchable: false,sortable: true,orderable: true, width: '10%'},
            {data: 'status', name: 'status', sortable: true,orderable: true, width: '10%'},
            {data: 'created_at', name: 'created_at', sortable: true,orderable: true, width: '10%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '30%'},
        ],
        order: [[6, 'desc']],
    });
    $('#data-table-search').keyup(function () {
        clerksTable.search(this.value).draw();
        })
</script>
@endpush
