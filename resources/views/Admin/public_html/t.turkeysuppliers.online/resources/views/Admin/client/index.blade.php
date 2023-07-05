@extends('Admin.layouts.master')
@section('title',__('company.buyer'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('company.buyer') }}</h3>
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
                    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary btn-sm mb-3">{{ __('company.newbuyer') }}</a>
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
                                <h4 class="card-title">{{ __('company.allbuyer') }}</h4>
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
                                        <table class="table table-striped table-bordered " id="companies-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('company.name') }}</th>
                                                    <th>{{ __('company.email') }}</th>
                                                    <th>{{ __('company.phone') }}</th>
                                                    <th>{{trans('product.adminadd')}}</th>
                                                    <th>{{ __('categories.created_at') }}</th>
                                                    <th>{{trans('product.adminedit')}}</th>
                                                    <th>{{ __('categories.updated_at') }}</th>
                                                    <th>{{ __('company.transactions') }}</th>
                                                    <th>{{ __('company.phone') }}</th>
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
    let comTable = $('#companies-table').DataTable({
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
            url: '{{ route('admin.clients.data') }}',
            type: 'GET',
            data: function (d) {
                d.filter = $('select[name=filter]').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            {data: 'name', name: 'name', searchable: true, sortable: true, width: '30%'},
            {data: 'email', name: 'email', searchable: true, sortable: true},
            {data: 'phonecode', name: 'phonecode', searchable: false, sortable: true,width: '10%'},
            {data: 'admin_add', name: 'admin_add', sortable: true, width: '5%'},
            {data: 'created_at', name: 'created_at', sortable: true, width: '5%'},
            {data: 'admin_edit', name: 'admin_edit', sortable: true, width: '5%'},
            {data: 'updated_at', name: 'updated_at', sortable: true, width: '5%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '22%'},
            {data: 'phone', name: 'phone', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
        ],
        order: [[5, 'desc']],
    });
    $('#data-table-search').keyup(function () {
        comTable.search(this.value).draw();
    })

</script>
@endpush
