@extends('Admin.layouts.master')
@section('title', trans('company.show_buyer'))
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{ trans('company.show_buyer') }}
                                        {{ $company->name }}</h4>
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.name') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $company->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.email') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $company->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.country') }}</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $company->country }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.created_at') }}</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $company->created_at->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.phone') }}</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $company->phone }}">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.phone1') }}</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $company->phone1 }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.phone2') }}</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $company->phone2 }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.phone3') }}</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $company->phone3 }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('company.plan') }}</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $company->plan?->title }}">
                                            </div>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <tr>
                                                    <td>{{ __('profile.desc') }}:</td>
                                                    <td>{!! $company->description !!}</td>
                                                </tr>
                                            </div>
                                        </div>
                                    </div> --}}
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

@endpush
