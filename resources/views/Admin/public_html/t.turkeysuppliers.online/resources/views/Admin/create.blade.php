@extends('Admin.layouts.master')
@section('title', __('aboutnew.newabout'))
@section('css')

@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{ __('aboutnew.newabout') }}</h4>
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
                                        <form  class="form" action="{{ route('admin.aboutnews.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('aboutnew.desc') }}</label>
                                                        <input type="text" class="form-control tinymce"
                                                            name="subject" value="{{ old('subject') }}"
                                                            placeholder="{{ __('aboutnew.desc') }}">
                                                    </div>
                                                    @error('subject')
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
                                                        'attribute' => 'subject',
                                                        'translations' => [],
                                                    ])
                                                </div>
                                            </div>
                                            <div class=" col-md-6 mb-2">
                                                    <label for="projectinput2">{{ trans('aboutnew.image') }}</label>
                                                    <div class="">
                                                        <input type="file" id=""
                                                            class="form-control img" name="image"
                                                             accept="image/*" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('images/Logo.jpg') }}" alt="" class="img-thumbnail img-preview" width="100px">
                                                    </div>
                                                @error('image')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status">{{ __('aboutnew.status') }}</label>
                                                <select name="status" class="form-control">
                                                    <option value="" selected readonly disabled>--{{ __('aboutnew.choose') }}--</option>
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>{{ __('aboutnew.active') }}</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>{{ __('aboutnew.unactive') }}</option>
                                                </select>
                                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
