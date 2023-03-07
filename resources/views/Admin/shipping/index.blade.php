@extends('Admin.layouts.master')
@section('title',__('shipment_order_news.shipment_order_news'))
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
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('shipment_order_news.shipment_order_news') }}</h3>
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
                                    <h4 class="card-title">{{ __('shipment_order_news.allshipment_order_new') }}</h4>
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
                                            <table class="table table-striped table-bordered  zero-configuration" id="categories-table" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ trans('custom.shipping_way') }}</th>
                                                    <th>{{ trans('custom.receiving_from_the_supplier') }}</th>
                                                    <th>{{ trans('custom.input_unit') }}</th>
                                                    <th>{{ trans('custom.length')}}</th>
                                                    <th>{{ trans('custom.width')}}</th>
                                                    <th>{{ trans('custom.height')}}</th>
                                                    <th>{{ trans('custom.dimensional_weight')}}</th>

                                                    <th>{{ trans('custom.weight_unit')}}</th>
                                                    <th>{{ trans('custom.package_weight')}}</th>
                                                    <th>{{ trans('custom.number_of_packages')}}</th>
                                                    <th>{{ trans('custom.shipment_destination')}}</th>

                                                    <th>{{ trans('shipment_order_news.client_name')}}</th>
                                                    <th>{{ trans('custom.your_comapny')}}</th>
                                                    <th>{{ trans('custom.tel')}}</th>
                                                    <th>{{ trans('custom.email')}}</th>
                                                    <th>{{ trans('custom.country')}}</th>
                                                    <th>{{ trans('custom.supplier_name')}}</th>
                                                    <th>{{ trans('custom.supplier_phone')}}</th>
                                                    <th>{{ trans('custom.supplier_email')}}</th>
                                                    <th>{{ __('categories.created_at') }}</th>
                                                    <th>{{ __('categories.transaction') }}</th>
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
{{-- <script>
    $(document).ready(function () {
$('.dtHorizontalExample').DataTable({
    "scrollX": true
});
$('.dataTables_length').addClass('bs-select');
}); --}}
{{-- </script> --}}
    <script>
        let countriesTable = $('#categories-table').DataTable({
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
                url: '{{ route('admin.shippings.data') }}',
                type: 'GET',
            },
            columns: [

                {data: 'DT_RowIndex', name: '', orderable:false, searchable: false},
                {data: 'shipment_name', name: 'shipment_name', searchable: true,sortable: true,orderable: true,width: '5%'},
                {data: 'shipment_type', name: 'shipment_type', sortable: true,orderable: true,width: '5%'},
                {data: 'unit', name: 'unit', sortable: true,orderable: true,width: '5%'},
                {data: 'length', name: 'length', sortable: true,orderable: true,width: '5%'},
                {data: 'width', name: 'width', sortable: true,orderable: true,width: '5%'},
                {data: 'height', name: 'height', sortable: true,orderable: true,width: '5%'},
                {data: 'dimensional_weight', name: 'dimensional_weight', sortable: true,orderable: true,width: '5%'},

                {data: 'weightunit', name: 'weightunit', sortable: true,orderable: true,width: '5%'},
                {data: 'weight', name: 'weight', sortable: true,orderable: true,width: '5%'},
                {data: 'package_no', name: 'package_no', sortable: true,orderable: true,width: '5%'},
                {data: 'destination', name: 'destination', sortable: true,orderable: true,width: '5%'},

                {data: 'name', name: 'name', sortable: true,orderable: true,width: '5%',searchable: true},
                {data: 'companyname', name: 'companyname', sortable: true,orderable: true,width: '5%',searchable: true},
                {data: 'phone', name: 'phone', sortable: true,orderable: true,width: '5%',searchable: true},
                {data: 'email', name: 'email', sortable: true,orderable: true,width: '5%',searchable: true},
                {data: 'country', name: 'country', sortable: true,orderable: true,width: '5%'},
                {data: 'vendorname', name: 'vendorname', sortable: true,orderable: true,width: '5%'},
                {data: 'vendorphone', name: 'vendorphone', sortable: true,orderable: true,width: '5%'},
                {data: 'vendoremail', name: 'vendoremail', sortable: true,orderable: true,width: '5%'},
                {data: 'created_at', name: 'created_at', sortable: true, width: '5%'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[20, 'desc']],
        });
    </script>

@endpush
