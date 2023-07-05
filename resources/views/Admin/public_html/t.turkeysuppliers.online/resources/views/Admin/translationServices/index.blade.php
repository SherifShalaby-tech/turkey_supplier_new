@extends('Admin.layouts.master')
@section('title', __('translationServices.translationServices'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('translationServices.translationServices') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.home') }}</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
            {{-- <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    @if (auth()->user()->hasPermission('create_translationServices'))
                    <a href="{{ route('admin.translationServices.create') }}" class="btn btn-primary btn-sm mb-3"> {{ __('translationServices.newtranslationServices') }}</a>
                    @endif
                </div>
            </div> --}}
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('translationServices.alltranslationServices') }}</h4>
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
                                    <table class="table table-striped table-bordered zero-configuration" id="translationServices-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
{{--                                                <th>{{ __('translationServices.image') }}</th>--}}
                                                <th>{{ __('translationServices.name') }}</th>
                                                <th>{{ __('translationServices.companyname') }}</th>
                                                <th>{{ __('translationServices.phone') }}</th>
{{--                                                <th>{{ __('translationServices.country') }}</th>--}}
                                                <th>{{ __('translationServices.language') }}</th>
                                                <th>{{ __('translationServices.tocompanyname') }}</th>
                                                <th>{{ __('translationServices.tocompanyphone') }}</th>
                                                <th>{{ __('translationServices.tocompanyemail') }}</th>
                                                <th>{{ __('translationServices.created_at') }}</th>
                                                {{-- @if (auth()->user()->hasPermission('update_translationServices','delete_translationServices')) --}}
                                                <th>{{ __('translationServices.transactions') }}</th>
                                                {{-- @endif --}}
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
    let countriesTable = $('#translationServices-table').DataTable({
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
            url: '{{ route('admin.translationServices.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            // {data: 'image', name: 'image', searchable: false, sortable: false, width: '10%'},
            {data: 'name', name: 'name', searchable: true, sortable: false},
            {data: 'companyname', name: 'companyname', searchable: false, sortable: false},
            {data: 'phone', name: 'phone', searchable: false, sortable: false},
            // {data: 'country', name: 'country', searchable: false, sortable: false},
            {data: 'languages', name: 'languages', searchable: false, sortable: false},
            {data: 'tocompanyname', name: 'tocompanyname', searchable: false, sortable: false},
            {data: 'tocompanyphone', name: 'tocompanyphone', searchable: false, sortable: false},
            {data: 'tocompanyemail', name: 'tocompanyemail', searchable: false, sortable: false},
            {data: 'created_at', name: 'created_at', sortable: true},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
        ],
        order: [[8, 'desc']],
    });
</script>
@endpush
