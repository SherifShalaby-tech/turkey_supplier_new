@extends('Admin.layouts.master')

@section('title',__('sub_categories.sub_categories'))



@section('css')
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">

                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('sub_categories.sub_categories') }}</h3>

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
                        @if (auth()->user()->hasPermission('create_sub_categories'))
                        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary btn-sm mb-3">{{ __('sub_categories.name') }}</a>
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
            </div>
            <div class="content-body">
                <section >
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <h4 class="card-title">{{ __('sub_categories.allsubcategory') }}</h4>

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
                                            <table class="table table-striped table-bordered " id="subcategories-table" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>

                                                    <th>{{ __('categories.image') }}</th>
                                                    <th>{{ __('sub_categories.name') }}</th>
                                                    <th>{{ __('categories.name') }}</th>
                                                    <th>{{trans('product.adminadd')}}</th>
                                                    <th>{{ __('categories.created_at') }}</th>
                                                    <th>{{trans('product.adminedit')}}</th>
                                                    <th>{{ __('categories.updated_at') }}</th>
                                                    <th>{{ __('categories.transaction') }}</th>
                                                    <th>{{trans('product.namear')}}</th>
                                                    <th>{{trans('product.nameen')}}</th>
                                                    <th>{{trans('product.nametr')}}</th>
                                                    <th>{{trans('product.descar')}}</th>
                                                    <th>{{trans('product.descen')}}</th>
                                                    <th>{{trans('product.desctr')}}</th>
                                                    {{-- <th>{{trans('product.catar')}}</th>
                                                    <th>{{trans('product.caten')}}</th>
                                                    <th>{{trans('product.cattr')}}</th> --}}

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
        let subcatTable = $('#subcategories-table').DataTable({
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
                url: '{{ route('admin.subcategories.data') }}',
                type: 'GET',
                data: function (d) {
                    d.cat_id = cat;
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'image', name: 'image', searchable: false, sortable: false, width: '10%'},
                {data: 'name', name: 'name', searchable: true, sortable: true,orderable: true},
                {data: 'category_id', name: 'category_id',sortable: false},
                {data: 'admin_add', name: 'admin_add', sortable: true, width: '10%'},
                {data: 'created_at', name: 'created_at', sortable: true, width: '10%'},
                {data: 'admin_edit', name: 'admin_edit', sortable: true, width: '10%'},
                {data: 'updated_at', name: 'updated_at', sortable: true, width: '10%'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
                {data: 'namear', name: 'namear', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                {data: 'nameen', name: 'nameen', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                {data: 'nametr', name: 'nametr', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                {data: 'descar', name: 'descar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                {data: 'descen', name: 'descen', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                {data: 'desctr', name: 'desctr', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                // {data: 'catar', name: 'catar', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                // {data: 'caten', name: 'caten', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
                // {data: 'cattr', name: 'cattr', searchable: true, sortable: true,orderable: true, width: '30%', visible: false},
            ],
            order: [[5, 'desc']],
        });
        $('#data-table-search').keyup(function () {
            subcatTable.search(this.value).draw();
        })
        $('#cat').on('change', function () {
            cat = this.value;
            subcatTable.ajax.reload();
        })
    </script>
@endpush
