@extends('Admin.layouts.master')
@section('title',__('translations.translations'))
@section('css')
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{trans('translations.translations')}}</h3>
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
                        @include('Admin.translations.btn.add')
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{trans('translations.translations')}}</h4>
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
                                        <form action="{{ route('admin.translations.update', $translation->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{trans('mediations.title')}}</label>
                                                            <input type="text" id="projectinput2" class="form-control"  name="title"
                                                                   value="{{ old('title',$translation->title) }}" placeholder="title">
                                                        </div>
                                                        @error('title')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button style="height: 40px;" class="btn btn-primary"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#translation_table_translation" aria-expanded="false"
                                                            aria-controls="collapseExample">
                                                        {{ __('company.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_inputs', [
                                                        'attribute' => 'title',
                                                        'translations' => [],
                                                        'type' => 'translation',
                                                        'data' => $translation
                                                    ])
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{trans('products.description')}}</label>
                                                            <textarea id="projectinput2" class="form-control tinymce"  name="description"
                                                                      placeholder="{{trans('products.description')}}">{{ $translation->description }}</textarea>
                                                        </div>
                                                        @error('description')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
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
                                                        'data' => $translation,
                                                    ])
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">{{ trans('site.save') }}</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('site.cancel') }}</button>
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


