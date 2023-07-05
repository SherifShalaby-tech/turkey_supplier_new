@extends('Admin.layouts.master')
@section('title',trans('product.products'))
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
                    <h3 class="content-header-title mb-0 d-inline-block">{{trans('product.products')}}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.home') }}</a>  </li>
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        @if (auth()->user()->hasPermission('create_product'))
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm mb-3">{{trans('product.new_product')}}</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')" >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select id="cat" class="form-control select2" required>
                            <option value="">@lang('site.all') @lang('categories.categories')</option>
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == request()->cat_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select id="subcat" class="form-control select2" required>
                            <option value="">@lang('site.all') @lang('subcategory.subcategories')</option>
                            @foreach ($subcats as $subcat)
                                <option value="{{ $subcat->id }}" {{ $subcat->id == request()->subcat_id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if(Auth::guard('admin')->user())

                <div class="col-md-3">
                    <div class="form-group">
                        <select id="company" class="form-control select2" required>
                            <option value="">@lang('site.all') @lang('company.company')</option>
                            @foreach ($coms as $com)
                                <option value="{{ $com->id }}" {{ $com->id == request()->com_id ? 'selected' : '' }}>{{ $com->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>
            <div class="content-body">
                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{trans('product.products')}}</h4>
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
                                            <table class="table table-striped table-bordered table-sm " id="products-table" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
{{--                                                        {{dd(\App\Models\Product::where('company_id',auth('company')->user()->id)->count())}}--}}
                                                        <th>#</th>
                                                        <th>{{trans('product.datatable')}}</th>
                                                        <th>{{trans('product.name')}}</th>
                                                        <th>{{trans('product.description')}}</th>
                                                        <th>{{trans('product.category')}}</th>
                                                        <th>{{trans('product.sub_category')}}</th>
                                                        <th>{{trans('product.productimagecount')}}</th>
                                                        <th>{{trans('product.price')}}</th>
                                                        <th>{{trans('product.categoryandsub')}}</th>
                                                        <th>{{trans('product.company')}}</th>
                                                        <th>{{trans('product.adminadd')}}</th>
                                                        <th>{{ __('categories.created_at') }}</th>
                                                        <th>{{trans('product.adminedit')}}</th>
                                                        <th>{{ __('categories.updated_at') }}</th>
                                                        <th>{{ __('product.views') }}</th>
                                                        <th>{{trans('product.namear')}}</th>
                                                        <th>{{trans('product.nameen')}}</th>
                                                        <th>{{trans('product.nametr')}}</th>
                                                        <th>{{trans('product.descar')}}</th>
                                                        <th>{{trans('product.descen')}}</th>
                                                        <th>{{trans('product.desctr')}}</th>
                                                        {{-- <th>{{trans('product.companyar')}}</th>
                                                        <th>{{trans('product.companyen')}}</th>
                                                        <th>{{trans('product.companytr')}}</th>
                                                        <th>{{trans('product.catar')}}</th>
                                                        <th>{{trans('product.caten')}}</th>
                                                        <th>{{trans('product.cattr')}}</th>
                                                        <th>{{trans('product.subcatar')}}</th>
                                                        <th>{{trans('product.subcaten')}}</th>
                                                        <th>{{trans('product.subcattr')}}</th> --}}
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
    let cat = "{{ request()->cat_id }}";
    let subcat = "{{ request()->subcat_id }}";
    let com = "{{ request()->com_id }}";
    let productsTable = $('#products-table').DataTable({
        // dom: 'lrtip',
        // "dom": '<"top"i>rt<"bottom"flp><"clear">',
        // "dom": 'B<lf<t>ip>',
        // "dom": '<"wrapper"flipt>',
        // "dom": 'Blfrtip',
        // dom: 'lrtip',
        // dom: "tiplr",
        // dom: "Bplrtip",
        // responsive: true,
        // dom: 'Qfrtip',
        // dom: 'lBprtip',
        // responsive: true,
        // autoWidth: true,
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
            url: '{{ route('admin.products.data') }}',
            type: 'GET',
            data: function (d) {
                d.cat_id = cat;
                d.subcat_id = subcat;
                d.com_id = com;
            }
        },
        columns: [

            {data: 'DT_RowIndex', name: '', sortable: false , orderable: false, searchable: false},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '70%'},
            {data: 'name', name: 'name', searchable: true, sortable: true,orderable: true, width: '30%'},
            {data: 'description', name: 'description', searchable: false, sortable: true,orderable: true, width: '100%', visible: false},
            {data: 'category_id', name: 'category_id', sortable: true,orderable: true, width: '70%', visible: false},
            {data: 'subcategory_id', name: 'subcategory_id', sortable: true,orderable: true, width: '70%', visible: false},
            {data: 'productimagecount', name: 'productimagecount', searchable: false, sortable: true,orderable: true, width: '5%'},
            {data: 'price', name: 'price', searchable: false, sortable: true,orderable: true, width: '5%'},
            {data: 'categoryandsub', name: 'categoryandsub',  sortable: true,orderable: true, width: '20%'},
            {data: 'company', name: 'company', sortable: true,orderable: true, width: '30%'},
            {data: 'admin_add', name: 'admin_add', sortable: true,orderable: true, width: '5%'},
            {data: 'created_at', name: 'created_at', sortable: true,orderable: true, width: '5%'},
            {data: 'admin_edit', name: 'admin_edit', sortable: true,orderable: true, width: '5%'},
            {data: 'updated_at', name: 'updated_at', sortable: true,orderable: true, width: '5%'},
            {data: 'views', name: 'views', sortable: true,orderable: true, width: '5%'},
            {data: 'namear', name: 'namear', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            {data: 'nameen', name: 'nameen', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            {data: 'nametr', name: 'nametr', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            {data: 'descar', name: 'descar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            {data: 'descen', name: 'descen', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            {data: 'desctr', name: 'desctr', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'companyar', name: 'companyar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'companyen', name: 'companyen', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'companytr', name: 'companytr', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'catar', name: 'catar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'caten', name: 'caten', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'cattr', name: 'cattr', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'subcatar', name: 'subcatar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'subcatar', name: 'subcatar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            // {data: 'subcatar', name: 'subcatar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
        ],
        order: [[11, 'desc']],
    });
    $('#cat').on('change', function () {
        cat = this.value;
        productsTable.ajax.reload();
    })
    $('#subcat').on('change', function () {
        subcat = this.value;
        productsTable.ajax.reload();
    })
    $('#company').on('change', function () {
        com = this.value;
        productsTable.ajax.reload();
    })

    $('#data-table-search').keyup(function () {
        productsTable.search(this.value).draw();
    })

</script>

@endpush
