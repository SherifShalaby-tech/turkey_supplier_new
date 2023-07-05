@extends('Admin.layouts.master')
@section('title',__('aboutnew.aboutnew'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('aboutnew.aboutnew') }}</h3>
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
                    @if (auth()->user()->hasPermission('create_about_us'))
                    <a href="{{ route('admin.aboutnews.create') }}" class="btn btn-primary btn-sm mb-3">{{ __('aboutnew.newabout') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('aboutnew.allaboutnew') }}</h4>
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
                                        <table class="table table-striped table-bordered " id="companies-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('aboutnew.image') }}</th>
                                                    <th>{{ __('aboutnew.desc') }}</th>
                                                    <th>{{ __('aboutnew.status') }}</th>
                                                    <th>{{trans('product.adminadd')}}</th>
                                                    <th>{{ __('categories.created_at') }}</th>
                                                    <th>{{trans('product.adminedit')}}</th>
                                                    <th>{{ __('categories.updated_at') }}</th>
                                                    <th>{{ __('aboutnew.transactions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($aboutnews as $index=>$aboutnew)
                                                    <tr>

                                                        <th scope="row">{{ $index +1 }}</th>
                                                        <td>
                                                            @if($aboutnew->image)
                                                            <img src="{{ asset('images/about_us/'.$aboutnew->image) }}" alt="" class="img-thumbnail"
                                                            width="100px" >
                                                            {{-- {!! $aboutnew->subject !!} --}}
                                                            @else
                                                            <img src="{{ asset('images/Logo.jpg') }}" alt="" class="img-thumbnail" width="100px">
                                                            @endif
                                                        </td>
                                                        <td>{!! Str::limit($aboutnew->subject, 20) !!}</td>
                                                        <td>{{ $aboutnew->status()}}</td>
                                                        <td>{{ $aboutnew->admin_add}}</td>
                                                        <td>{{ $aboutnew->created_at() }}</td>
                                                        <td>{{ $aboutnew->admin_edit}}</td>
                                                        <td>{{ $aboutnew->updated_at()}}</td>
                                                        <td>
                                                            @include('Admin.aboutnews.data_table.actions')
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center">{{ __('aboutnew.noaboutnew') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <tfoot>
                                            <tr>
                                                <th colspan="12">
                                                    <div class="float-right">
                                                        {!! $aboutnews->appends(request()->all())->links() !!}
                                                    </div>
                                                </th>
                                            </tr>
                                        </tfoot>
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
    let countriesTable = $('#companies-table').DataTable({
        // dom: 'Blfrtip',
        // "scrollX": true,
        serverSide: true,
        processing: true,
        lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        "language": {
            "url": "{{ asset('dashboard/datatable-lang/' . app()->getLocale() . '.json') }}"
        },
        ajax: {
            url: '{{ route('admin.companies.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},

            {data: 'name', name: 'name', searchable: true, sortable: true},

            {data: 'email', name: 'email', searchable: true, sortable: true},
            {data: 'phonecode', name: 'phonecode', searchable: true, sortable: true,width: '10%'},
            // {data: 'description', name: 'description', searchable: false, sortable: false,width: '10%'},
            // {data: 'images', name: 'images', searchable: false, sortable: false},
            {data: 'admin_add', name: 'admin_add', sortable: true, width: '10%'},
            {data: 'created_at', name: 'created_at', sortable: true, width: '10%'},
            {data: 'admin_edit', name: 'admin_edit', sortable: true, width: '10%'},
            {data: 'updated_at', name: 'updated_at', sortable: true, width: '10%'},
            {data: 'views', name: 'views', sortable: true, width: '10%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '22%'},
        ],
    });
</script> --}}
@endpush
