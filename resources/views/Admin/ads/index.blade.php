@extends('Admin.layouts.master')
@section('title',__('ads.ads'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{trans('ads.ads')}}</h3>
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
                    @if (auth()->user()->hasPermission('create_ads'))
                        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal"
                                data-target="#add">
                            {{ trans('site.add') }}
                        </button>
                    @endif
                    @include('Admin.ads.btn.add')
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{trans('ads.allad')}}</h4>
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
                                    <table class="table table-striped table-bordered " id="ads-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('ads.image')}}</th>
                                                <th>{{trans('ads.title')}}</th>
                                                <th>{{trans('ads.name_entity')}}</th>
                                                <th>{{trans('ads.start_date')}}</th>
                                                <th>{{trans('ads.end_date')}}</th>
                                                <th>{{trans('site.created_at')}}</th>
                                                <th>{{trans('ads.datatable')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ads as $ad)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>
                                                    @if($ad->image)
                                                    <img src="{{asset('images/ads/' . $ad->image)}}" alt="{{ $ad->title }}" class="img-thumbnail" width="100px">
                                                    @else
                                                    <img src="{{asset('images/no-image.png')}}" alt="{{ $ad->title }}" class="img-thumbnail" width="100px">
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $ad->image }}</td> --}}
                                                <td>{{ $ad->title }}</td>
                                                <td>{{ $ad->name_entity }}</td>
                                                <td>{{ $ad->start_date }}</td>
                                                <td>{{ $ad->end_date }}</td>
                                                <td>{{ $ad->created_at() }}</td>
                                                <td class="d-flex gap-2">
                                                    @include('Admin.ads.data_table.actions')
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $ads->links() }}
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

