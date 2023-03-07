@extends('Admin.layouts.master')
@section('title',__('tradeshows.tradeshows'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{trans('tradeshows.tradeshows')}}</h3>
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
                    <a href="{{ route('admin.tradeShows.create') }}" class="btn btn-primary btn-sm mb-3"> {{ trans('site.add') }}</a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{trans('tradeshows.tradeshows')}}</h4>
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
                                    <table class="table table-striped table-bordered zero-configuration" id="tradeShow-table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('tradShow.title')}}</th>
                                                <th>{{trans('tradShow.linkurl')}}</th>
                                                <th>{{trans('tradShow.videourl')}}</th>
                                                <th>{{trans('product.adminadd')}}</th>
                                                <th>{{ __('categories.created_at') }}</th>
                                                <th>{{trans('product.adminedit')}}</th>
                                                <th>{{ __('categories.updated_at') }}</th>
                                                <th>{{trans('site.actions')}}</th>
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
    let countriesTable = $('#tradeShow-table').DataTable({
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
            url: '{{ route('admin.tradeShows.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            {data: 'title', name: 'title', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'linkurl', name: 'linkurl', sortable: true,orderable: true, width: '10%'},
            {data: 'videourl', name: 'videourl', sortable: true,orderable: true, width: '10%'},
            {data: 'admin_add', name: 'admin_add', sortable: true,orderable: true, width: '5%'},
            {data: 'created_at', name: 'created_at', sortable: true,orderable: true, width: '5%'},
            {data: 'admin_edit', name: 'admin_edit', sortable: true,orderable: true, width: '5%'},
            {data: 'updated_at', name: 'updated_at', sortable: true,orderable: true, width: '5%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '22%'},
        ],
        order: [[5, 'desc']],
    });
</script>
@endpush
