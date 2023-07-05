@extends('Admin.layouts.master')
@section('title',__('plans.plans'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{trans('plans.plans')}}</h3>
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
                    <a href="{{ route('admin.plans.create') }}" class="btn btn-primary btn-sm mb-3">{{trans('plans.newplan')}}</a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{trans('plans.allplans')}}</h4>
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
                                    <table class="table table-striped table-bordered zero-configuration" id="plans-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('plans.title')}}</th>
                                                <th>{{trans('plans.character_count')}}</th>
                                                <th>{{trans('plans.company_picture_count')}}</th>
                                                <th>{{trans('plans.product_count')}}</th>
                                                <th>{{trans('plans.product_picture_count')}}</th>
                                                <th>{{trans('plans.video_time')}}</th>
                                                <th>{{trans('plans.video_count')}}</th>
                                                <th>{{trans('plans.price')}}</th>
                                                <th>{{trans('plans.created_date')}}</th>
                                                <th>{{trans('plans.actions')}}</th>
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
    let countriesTable = $('#plans-table').DataTable({
        // dom: 'Blfrtip',
        "scrollX": true,
        serverSide: true,
        processing: true,
        lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        "language": {
            "url": "{{ asset('dashboard/datatable-lang/' . app()->getLocale() . '.json') }}"
        },
        ajax: {
            url: '{{ route('admin.plans.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            {data: 'title', name: 'title', searchable: true, sortable: true},
            {data: 'character_count', name: 'character_count', searchable: true, sortable: true},
            {data: 'company_picture_count', name: 'company_picture_count', searchable: false, sortable: true},
            {data: 'product_count', name: 'product_count', searchable: false, sortable: true,width: '5%'},
            {data: 'product_picture_count', name: 'product_picture_count', searchable: false, sortable: true,width: '5%'},
            {data: 'video_time', name: 'video_time', searchable: false, sortable: true,width: '5%'},
            {data: 'video_count', name: 'video_count', searchable: false, sortable: true,width: '5%'},
            {data: 'price', name: 'price', searchable: false, sortable: true,width: '5%'},
            {data: 'created_at', name: 'created_at', sortable: true,width: '5%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: true, width: '22%'},
        ],
        order: [[9, 'desc']],
    });
</script>
@endpush
