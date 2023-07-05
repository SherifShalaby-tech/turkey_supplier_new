@extends('Admin.layouts.master')
@section('title',trans('newcat.newsubcat'))
@section('css')
<style>
    th {
    white-space: break-spaces;
}
.dtHorizontalExampleWrapper {
  max-width: 600px;
  margin: 0 auto;
}
.dtHorizontalExample th, td {
  white-space: nowrap;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
 bottom: .5em;
}
</style>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{trans('newcat.newsubcat')}}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.home') }}</a>  </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="column-selectors">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{trans('newcat.newsubcat')}}</h4>
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
                                            <table class="table table-striped table-bordered table-sm dtHorizontalExample" id="newcats-table" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{trans('newcat.subcategoryname')}}</th>
                                                        <th>{{trans('newcat.catname')}}</th>
                                                        <th>{{trans('newcat.username')}}</th>
                                                        <th>{{trans('newcat.useremail')}}</th>
                                                        <th>{{trans('newcat.userphone')}}</th>
                                                        <th>{{trans('newcat.status')}}</th>
                                                        <th>{{trans('newcat.creatat')}}</th>
                                                        <th>{{trans('newcat.datatable')}}</th>
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
    let newcatsTable = $('#newcats-table').DataTable({
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
            url: '{{ route('admin.newsubcats.data') }}',
            type: 'GET',
        },
        columns: [

            {data: 'DT_RowIndex', name: '', sortable: false , orderable: false, searchable: false},
            {data: 'subcategoryname', name: 'subcategoryname', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'categoryname', name: 'categoryname', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'username', name: 'username', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'useremail', name: 'useremail', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'userphone', name: 'userphone', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'status', name: 'status', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'created_at', name: 'created_at', sortable: true,orderable: true, width: '5%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '70%'},
        ],
        order: [[7, 'desc']],
    });
</script>

@endpush
