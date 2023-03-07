@extends('Admin.layouts.master')
@section('title',__('reports.reports'))
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
                <h3 class="content-header-title mb-0 d-inline-block">{{trans('reports.sellereports')}}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ __('reports.sellercount') }}
                                <strong style="color: red;">({{ App\Models\Company::where('trade_role','seller')->count() }})</strong>
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
                                {{-- <h4 class="card-title">{{trans('reports.allreport')}}</h4> --}}
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
                                    <table class="table table-striped table-bordered table-sm dtHorizontalExample" id="reports-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('reports.company')}}</th>
                                                <th>{{trans('reports.creator')}}</th>
                                                <th>{{ __('categories.created_at') }}</th>
                                                <th>{{trans('reports.editor')}}</th>
                                                <th>{{ __('categories.updated_at') }}</th>
                                                <th>{{trans('reports.membership')}}</th>
                                                <th>{{trans('reports.fees')}}</th>
                                                <th>{{trans('reports.profilevisit')}}</th>
                                                <th>{{trans('reports.companyproductcount')}}</th>
                                                <th>{{trans('reports.productvisit')}}</th>
                                                <th>{{trans('reports.companysendsms')}}</th>
                                                <th>{{trans('reports.companyreceivesms')}}</th>
                                            </tr>
                                        </thead>
                                        {{-- <tbody>
                                            @foreach ($companys as $company)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->admin_add }}</td>
                                                <td>{{ $company->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $company->admin_edit }}</td>
                                                <td>{{ $company->updated_at->format('Y-m-d') }}</td>
                                                <td>{{ $company->plan?->title }}</td>
                                                <td>{{ $company->plan?->price }}</td>
                                                <td>{{ $company->views }}</td>
                                                <td>{{ $company->products?->count() }}</td>
                                                <td>{{ App\Models\Product::where('company_id',$company->id)->sum('views') }}</td>
                                                <td>{{ App\Models\ContactSupplier::where('supplier_id',$company->id)->count('message') }}</td>
                                                <td>{{ App\Models\ContactSupplier::where('user_id',$company->id)->count('message') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody> --}}
                                    </table>
                                    {{-- {{ $companys->links() }} --}}
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
    let productsTable = $('#reports-table').DataTable({
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
            url: '{{ route('admin.reportsdata') }}',
            type: 'GET',

        },
        columns: [

            {data: 'DT_RowIndex', name: '', sortable: false , orderable: false, searchable: false},
            {data: 'name', name: 'name', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'admin_add', name: 'admin_add', sortable: true,orderable: true, width: '5%'},
            {data: 'created_at', name: 'created_at', sortable: true,orderable: true, width: '5%'},
            {data: 'admin_edit', name: 'admin_edit', sortable: true,orderable: true, width: '5%'},
            {data: 'updated_at', name: 'updated_at', sortable: true,orderable: true, width: '5%'},
            {data: 'plan', name: 'plan', sortable: true,orderable: true, width: '5%'},
            {data: 'fees', name: 'fees', sortable: true,orderable: true, width: '5%'},
            {data: 'views', name: 'views', sortable: true,orderable: true, width: '5%'},
            {data: 'productcount', name: 'productcount', sortable: true,orderable: true, width: '5%'},
            {data: 'productvisit', name: 'productvisit', sortable: true,orderable: true, width: '5%'},
            {data: 'companysendsms', name: 'companysendsms', sortable: true,orderable: true, width: '5%'},
            {data: 'companyreceivesms', name: 'companyreceivesms', sortable: true,orderable: true, width: '5%'},
        ],
        order: [[3, 'desc']],
    });

    // $('#data-table-search').keyup(function () {
    //     productsTable.search(this.value).draw();
    // })
</script>

@endpush
