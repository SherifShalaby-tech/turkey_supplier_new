@extends('Admin.layouts.master')
@section('title', __('categories.editcategory'))
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
                                    <h4 class="card-title" id="basic-layout-form">{{ __('categories.editcategory') }}</h4>
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
                                        <form class="form" action="{{ route('admin.categories.update', 'test') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('categories.name') }}</label>
                                                            <input type="text" id="projectinput1" class="form-control"
                                                                name="name" value="{{ $category->name }}"
                                                                placeholder="{{ __('categories.name') }}">
                                                        </div>
                                                        @error('name')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                        type="button" data-toggle="collapse"
                                                        data-target="#translation_table_category" aria-expanded="false"
                                                        aria-controls="collapseExample">
                                                        {{ __('categories.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_inputs', [
                                                        'attribute' => 'name',
                                                        'translations' => [],
                                                        'type' => 'category',
                                                        'data' => $category,
                                                    ])
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('categories.desc') }}</label>
                                                            <textarea id="projectinput1" class="form-control tinymce" name="description">{{ $category->description }}</textarea>

                                                        </div>
                                                        @error('description')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                        type="button" data-toggle="collapse"
                                                        data-target="#translation_textarea_table" aria-expanded="false"
                                                        aria-controls="collapseExample">
                                                        {{ __('company.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_textarea', [
                                                        'attribute' => 'description',
                                                        'translations' => [],
                                                        'data' => $category,
                                                    ])
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ __('categories.image') }}</label>
                                                        <input type="file" id="projectinput2"  class="form-control img" name="image" accept="image/*" />
                                                    </div>
                                                    @error('image')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    @if ($category->image)
                                                        <img src="{{ asset('images/categories/' . $category->image) }}"
                                                            alt="" class="img-thumbnail img-preview"  style="width: 100px;">
                                                    @else
                                                        <img src="{{ asset('images/logo.png') }}" alt=""
                                                            class="img-thumbnail img-preview" width="100px">
                                                    @endif
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
            </div>
        </div>
    </div>
@endsection
