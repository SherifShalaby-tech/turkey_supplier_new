@extends('Admin.layouts.master')
@section('title',__('mediations.mediations'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{trans('mediations.mediations')}}</h3>
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
                    {{-- @if (auth()->user()->hasPermission('create_mediations')) --}}
                        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal"
                                data-target="#add">
                            {{ trans('site.add') }}
                        </button>
                    {{-- @endif --}}
                    @include('Admin.mediations.btn.add')
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{trans('mediations.allmediation')}}</h4>
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
                                        <table class="table table-striped table-bordered " id="mediations-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{trans('mediations.image')}}</th>
                                                    <th>{{trans('mediations.title')}}</th>
                                                    <th>{{trans('product.adminadd')}}</th>
                                                    <th>{{ __('categories.created_at') }}</th>
                                                    <th>{{trans('product.adminedit')}}</th>
                                                    <th>{{ __('categories.updated_at') }}</th>
                                                    <th>{{trans('mediations.datatable')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mediations as $mediation)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>
                                                        @if($mediation->image)
                                                        <img src="{{asset('images/mediations/' . $mediation->image)}}" alt="{{ $mediation->title }}" class="img-thumbnail" width="100px">
                                                        @else
                                                        <img src="{{asset('images/no-image.png')}}" alt="{{ $mediation->title }}" class="img-thumbnail" width="100px">
                                                        @endif
                                                    </td>
                                                    <td>{{ $mediation->title }}</td>
                                                    <td>{{ $mediation->admin_add }}</td>
                                                    <td>{{ $mediation->created_at ?? now() }}</td>
                                                    <td>{{ $mediation->admin_edit }}</td>
                                                    <td>{{ $mediation->updated_at ?? now() }}</td>
                                                    <td class="d-flex gap-2">
                                                        @include('Admin.mediations.data_table.actions')
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $mediations->links() }}
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
    $(".img").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush
