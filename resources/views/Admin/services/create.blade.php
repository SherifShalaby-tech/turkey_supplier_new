@extends('Admin.layouts.master')
@section('title',trans('service.newservice'))
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
                                    <h4 class="card-title" id="basic-layout-form">{{trans('service.newservice')}}</h4>
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
                                    <div class="card-body">
                                        <form  class="form" action="{{ route('admin.services.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12 mb-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">{{ trans('services.name') }}</label>
                                                                <input type="text" class="form-control" name="name"
                                                                       value="{{ old('name') }}"
                                                                       placeholder="{{ trans('services.name') }}">
                                                            </div>
                                                            @error('name')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#translation_table_services" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                {{ __('company.addtranslations') }}
                                                            </button>
                                                            @include('Admin.layouts.translation_inputs', [
                                                                'attribute' => 'name',
                                                                'translations' => [],
                                                                'type' => 'services',
                                                            ])
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 mb-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="projectinput1">{{ trans('services.description') }}</label>

                                                                <input type="text" class="form-control tinymce" name="description"

                                                                       value="{{ old('description') }}"
                                                                       placeholder="{{ trans('services.description') }}">
                                                            </div>
                                                            @error('description')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#translation_textarea_table" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                {{ __('company.addtranslations') }}
                                                            </button>
                                                            @include('Admin.layouts.translation_textarea', [
                                                                'attribute' => 'description',
                                                                'translations' => [],
                                                            ])
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('services.images')}}</label>
                                                            <input type="file" id="projectinput1" class="form-control" name="images[]" multiple>
                                                        </div>
                                                        @error('images')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('service.video_link')}}</label>
                                                            <input type="text" id="projectinput1" class="form-control" name="video_link" value="{{ old('video_link') }}" placeholder="video_link">
                                                        </div>
                                                        @error('video_link')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ trans('services.images') }}</label>
                                                        <div class="file-loading">
                                                            <input type="file" id="services-images"
                                                                class="form-control file-input-overview" name="images[]"
                                                                multiple />
                                                        </div>
                                                    </div>
                                                    @error('images')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('admins.save') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>



                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script> --}}
    <script>
        $("#services-images").fileinput({
            // theme: "bs5",
            maxFileCount: 15,
            allowedFileTypes: ['image'],
            showCancel: true,
            showRemove: false,
            showUpload: false,
            overwriteInitial: false
        });
    </script>

@endpush
