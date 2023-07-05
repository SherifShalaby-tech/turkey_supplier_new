@extends('Admin.layouts.master')
@section('title', trans('product.new_product'))
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
          crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/themes/bs5/theme.css') }}"> --}}
    <style>
        .kv-file-upload {
            display: none;
        }

        .preview img {
            height: auto !important;
        }


    </style>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .preview-images-container {
            /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
            display: grid;
            grid-template-columns: repeat(auto-fill, 170px);
        }
        .preview-certificates-container {
            /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
            display: grid;
            grid-template-columns: repeat(auto-fill, 170px);
        }
        .preview {
            position: relative;
            width: 150px;
            height: 150px;
            padding: 4px;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            margin: 30px 0px;
            border: 1px solid #ddd;
        }

        .preview img {
            width: 100%;
            height: 100%;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
            object-fit: cover;

        }

        .delete-btn {
            position: absolute;
            top: 156px;
            right: 0px;
            /*border: 2px solid #ddd;*/
            border: none;
            cursor: pointer;
        }

        .delete-btn {
            background: transparent;
            color: rgba(235, 32, 38, 0.97);
        }

        .crop-btn {
            position: absolute;
            top: 156px;
            left: 0px;
            /*border: 2px solid #ddd;*/
            border: none;
            cursor: pointer;
            background: transparent;
            color: #007bff;
        }
    </style>
    <style>
        .variants {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .variants>div {
            margin-right: 5px;
        }

        .variants>div:last-of-type {
            margin-right: 0;
        }

        .file {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .file>input[type='file'] {
            display: none
        }

        .file>label {
            font-size: 1rem;
            font-weight: 300;
            cursor: pointer;
            outline: 0;
            user-select: none;
            border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186);
            border-style: solid;
            border-radius: 4px;
            border-width: 1px;
            background-color: hsl(0, 0%, 100%);
            color: hsl(0, 0%, 29%);
            padding-left: 16px;
            padding-right: 16px;
            padding-top: 16px;
            padding-bottom: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .file>label:hover {
            border-color: hsl(0, 0%, 21%);
        }

        .file>label:active {
            background-color: hsl(0, 0%, 96%);
        }

        .file>label>i {
            padding-right: 5px;
        }

        .file--upload>label {
            color: hsl(204, 86%, 53%);
            border-color: hsl(204, 86%, 53%);
        }

        .file--upload>label:hover {
            border-color: hsl(204, 86%, 53%);
            background-color: hsl(204, 86%, 96%);
        }

        .file--upload>label:active {
            background-color: hsl(204, 86%, 91%);
        }

        .file--uploading>label {
            color: hsl(48, 100%, 67%);
            border-color: hsl(48, 100%, 67%);
        }

        .file--uploading>label>i {
            animation: pulse 5s infinite;
        }

        .file--uploading>label:hover {
            border-color: hsl(48, 100%, 67%);
            background-color: hsl(48, 100%, 96%);
        }

        .file--uploading>label:active {
            background-color: hsl(48, 100%, 91%);
        }

        .file--success>label {
            color: hsl(141, 71%, 48%);
            border-color: hsl(141, 71%, 48%);
        }

        .file--success>label:hover {
            border-color: hsl(141, 71%, 48%);
            background-color: hsl(141, 71%, 96%);
        }

        .file--success>label:active {
            background-color: hsl(141, 71%, 91%);
        }

        .file--danger>label {
            color: hsl(348, 100%, 61%);
            border-color: hsl(348, 100%, 61%);
        }

        .file--danger>label:hover {
            border-color: hsl(348, 100%, 61%);
            background-color: hsl(348, 100%, 96%);
        }

        .file--danger>label:active {
            background-color: hsl(348, 100%, 91%);
        }

        .file--disabled {
            cursor: not-allowed;
        }

        .file--disabled>label {
            border-color: #e6e7ef;
            color: #e6e7ef;
            pointer-events: none;
        }

        @keyframes pulse {
            0% {
                color: hsl(48, 100%, 67%);
            }

            50% {
                color: hsl(48, 100%, 38%);
            }

            100% {
                color: hsl(48, 100%, 67%);
            }
        }
    </style>
@endsection
@section('content')
    @include('Admin.products.datatable.addcat')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="form-control-repeater">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="file-repeater">{{ trans('product.new_product') }}</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-h font-medium-3"></i></a>
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
                                        <form class="form row" action="{{ route('admin.products.store') }}"
                                              method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('product.name') }}</label>
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{ old('name') }}" required
                                                               placeholder="{{ trans('product.name') }}">
                                                    </div>
                                                    @error('name')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">

                                                    <button style="height: 40px;margin-top: 28px;"
                                                            class="btn btn-primary"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#translation_table_product"
                                                            aria-expanded="false"
                                                            aria-controls="collapseExample">
                                                        {{ __('company.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_inputs', [
                                                        'attribute' => 'name',
                                                        'translations' => [],
                                                        'type' => 'product',
                                                    ])
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">

                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <label
                                                            for="projectinput1">{{ trans('product.description') }}</label>
                                                        <textarea
                                                            @if(auth('company')->user()) maxlength="{{auth('company')->user()->plan->character_count}}"
                                                            @endif class="form-control tinymce" name="description"
                                                            placeholder="{{ trans('product.description') }}">

                                                            {{old('description')}}



                                                        </textarea>
                                                    </div>
                                                    @error('description')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <button style="height: 40px;margin-top: 28px;"
                                                            class="btn btn-primary"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#translation_textarea_table"
                                                            aria-expanded="false"
                                                            aria-controls="collapseExample">
                                                        {{ __('company.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_textarea', [
                                                        'attribute' => 'description',
                                                        'translations' => [],
                                                    ])


                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput2">{{ trans('product.certificates') }}</label>
                                                    <div class="container mt-3">
                                                        <div class="row mx-0"
                                                             style="border: 1px solid #ddd;padding: 30px 0px;">
                                                            <div class="col-12">
                                                                <div class="mt-3">
                                                                    <div class="row">
                                                                        <div class="col-10 offset-1">
                                                                            <div class="variants">
                                                                                <div class='file file--upload w-100'>
                                                                                    <label for='file-input-certificates'
                                                                                           class="w-100">
                                                                                        <i class="fas fa-cloud-upload-alt"></i>Upload
                                                                                    </label>
                                                                                    <input type="file"
                                                                                           id="file-input-certificates"
                                                                                           multiple>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-10 offset-1">
                                                                <div class="preview-certificates-container"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--                                                    <div class="file-loading">--}}
                                                    {{--                                                        <input type="file" id="product-images-ser" class="@error('certificates') is-invalid @enderror form-control file-input-overview" name="certificates[]" multiple />--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                                @error('certificates')
                                                <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('product.image') }}</label>
                                                    <div class="container mt-3">
                                                        <div class="row mx-0"
                                                             style="border: 1px solid #ddd;padding: 30px 0px;">
                                                            <div class="col-12">
                                                                <div class="mt-3">
                                                                    <div class="row">
                                                                        <div class="col-10 offset-1">
                                                                            <div class="variants">
                                                                                <div class='file file--upload w-100'>
                                                                                    <label for='file-input-images'
                                                                                           class="w-100">
                                                                                        <i class="fas fa-cloud-upload-alt"></i>Upload
                                                                                    </label>
                                                                                    <!-- <input  id="file-input" multiple type='file' /> -->
                                                                                    <input type="file"
                                                                                           id="file-input-images"
                                                                                           multiple>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-10 offset-1">
                                                                <div class="preview-images-container"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group col-md-12 mb-2"> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('product.category') }}</label>
                                                    @if (Auth::guard('company')->user())
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text btn btn-primary"
                                                                      id="basicat"
                                                                      data-toggle="modal" data-target="#addcat">
                                                                    <i class="la la-plus"></i>
                                                                </span>
                                                        </div>
                                                    @endif
                                                    <select class="form-control select2" name="category_id" required>

                                                        <option selected disabled
                                                                readonly value="">{{ trans('product.choose') }}</option>

                                                        @foreach ($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':null }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('category_id')<p class="text-danger"
                                                                        style="font-size: 12px">{{ $message }}</p>@enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput2">{{ trans('product.sub_category') }}</label>
                                                    @if (Auth::guard('company')->user())
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text btn btn-primary"
                                                                      id="basicsubcat"
                                                                      data-toggle="modal" data-target="#addsubcat">
                                                                    <i class="la la-plus"></i>
                                                                </span>
                                                        </div>
                                                    @endif
                                                    <select class="form-control select2" name="sub_category_id"
                                                            required>


                                                    </select>
                                                </div>
                                                @error('sub_category_id')
                                                <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput1">{{ trans('product.video_description') }}</label>
                                                    <input type="text" id="projectinput1" class="form-control"
                                                           name="video_description"
                                                           value="{{ old('video_description') }}"
                                                           placeholder="{{ trans('product.video_description') }}">
                                                </div>
                                                @error('video_description')
                                                <p class="text-danger" style="font-size: 12px">
                                                    {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">


                                                    <label for="projectinput2">{{ trans('products.company') }}</label>
                                                    <select class="form-control select2" name="company_id" required>
                                                        <option selected disabled

                                                                readonly value="">{{ trans('product.choose') }}</option>

                                                        @if(Auth::guard('admin')->user())
                                                            @foreach ($companies as $company)
                                                                <option
                                                                    value="{{ $company->id }}" {{ old('company_id')==$company->id?'selected':null }}>
                                                                    {{ $company->name }}</option>
                                                            @endforeach
                                                        @endif
                                                        @if(Auth::guard('company')->user())
                                                            <option
                                                                value="{{ App\Models\Company::whereId(Auth::guard('company')->user()->id)->first()->id }}"
                                                                selected>
                                                                {{ App\Models\Company::whereId(Auth::guard('company')->user()->id)->first()->name }}
                                                            </option>
                                                        @endif
                                                        @if(Auth::guard('clerk')->user())
                                                            <option
                                                                value="{{ App\Models\Company::whereId(Auth::guard('clerk')->user()->company_id)->first()->id }}"
                                                                selected>
                                                                {{ App\Models\Company::whereId(Auth::guard('clerk')->user()->company_id)->first()->name }}
                                                            </option>
                                                        @endif
                                                    </select>


                                                </div>
                                                @error('company_id')
                                                <p class="text-danger" style="font-size: 12px">
                                                    {{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- </div> --}}
                                            {{-- <div class="form-group col-md-12 mb-2"> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput1">{{ trans('products.price') }}</label>
                                                    <input type="text" id="projectinput1" class="form-control"
                                                           name="price" value="{{ old('price') }}"
                                                           placeholder="{{ trans('products.price') }}" required>
                                                </div>
                                                @error('price')
                                                <p class="text-danger" style="font-size: 12px">
                                                    {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput1">{{ trans('product.Packaging') }}</label>
                                                    <input type="text" id="projectinput1" class="form-control"
                                                           name="Packaging" value="{{ old('Packaging') }}"
                                                           placeholder="{{ trans('product.Packaging') }}">
                                                </div>
                                                @error('Packaging')
                                                <p class="text-danger" style="font-size: 12px">
                                                    {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput1">{{ trans('product.Supply_Ability') }}</label>
                                                    <input type="text" id="projectinput1" class="form-control"
                                                           name="Supply_Ability" value="{{ old('Supply_Ability') }}"
                                                           placeholder="{{ trans('product.Supply_Ability') }}">
                                                </div>
                                                @error('Supply_Ability')
                                                <p class="text-danger" style="font-size: 12px">
                                                    {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput1">{{ trans('product.Place_Origin') }}</label>
                                                    <input type="text" id="projectinput1" class="form-control"
                                                           name="Place_Origin" value="{{ old('Place_Origin') }}"
                                                           placeholder="{{ trans('product.Place_Origin') }}">
                                                </div>
                                                @error('Place_Origin')
                                                <p class="text-danger" style="font-size: 12px">
                                                    {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label
                                                        for="projectinput1">{{ trans('product.weight') }}</label>
                                                    <input type="text" id="projectinput1" class="form-control"
                                                           name="weight" value="{{ old('weight') }}"
                                                           placeholder="{{ trans('product.weight') }}">
                                                </div>
                                                @error('weight')
                                                <p class="text-danger" style="font-size: 12px">
                                                    {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label
                                                    for="projectinput1">{{ trans('product.tags') }}</label>
                                                <textarea class="form-control" name="tags">{{old('tags')}}</textarea>
                                            </div>
                                            {{-- </div> --}}
                                            <div class="form-group col-12 mb-2 file-repeater">
                                                <div data-repeater-list="class_list">
                                                    <div data-repeater-item>
                                                        <div class="row mb-1">
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('product.color') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                       name="colorName" value="{{ old('colorName') }}"
                                                                       placeholder="{{ trans('product.color') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('product.colorcode') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                       name="colorCode" value="{{ old('colorCode') }}"
                                                                       placeholder="{{ trans('product.colorcode') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('product.size') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                       name="sizeName" value="{{ old('sizeName') }}"
                                                                       id="" placeholder="{{ trans('product.size') }}">
                                                            </div>
                                                            {{-- <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('products.qty') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                name="qty" value="{{ old('qty') }}"
                                                                    id="" placeholder="{{ trans('products.qty') }}">
                                                            </div> --}}
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label
                                                                    for="">{{ trans('products.leadtime_price') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                       name="leadtime_price"
                                                                       value="{{ old('leadtime_price') }}"
                                                                       id=""
                                                                       placeholder="{{ trans('products.leadtime_price') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label
                                                                    for="">{{ trans('products.leadtime_qty') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                       name="leadtime_qty"
                                                                       value="{{ old('leadtime_qty') }}"
                                                                       id=""
                                                                       placeholder="{{ trans('products.leadtime_qty') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for=""
                                                                       class="d-block w-100">{{ trans('products.leadtime_days') }}</label>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <input type="text" class="form-control" name="days"
                                                                           value="{{ old('days') }}" id=""
                                                                           placeholder="{{ trans('products.leadtime_days') }}">
                                                                    <button type="button" data-repeater-delete
                                                                            class="btn btn-icon ml-2 btn-danger ">
                                                                        <i class="ft-x"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" data-repeater-create class="btn btn-primary">
                                                    <i class="ft-plus"></i>{{ __('products.add') }}
                                                </button>
                                            </div>
                                            <div class=" w-100 d-flex align-items-center justify-content-center">
                                                <button type="submit" class="btn btn-success px-4">
                                                    <i class="la la-check-square-o"></i> {{ __('admins.save') }}
                                                </button>
                                            </div>
                                            <div id="cropped_images"></div>
                                            <div id="cropped_certificates_images"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- ///////////////////////////// --}}
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagesModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="croppie-modal" style="display:none">
                        <div id="croppie-container"></div>
                        <button data-dismiss="modal" id="croppie-cancel-btn" type="button" class="btn btn-secondary"><i
                                class="fas fa-times"></i></button>
                        <button id="croppie-submit-btn" type="button" class="btn btn-primary"><i
                                class="fas fa-crop"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="certificatesModal" tabindex="-1" role="dialog" aria-labelledby="certificatesModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="certificatesModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="croppie-certificates-modal" style="display:none">
                        <div id="croppie-certificates-container"></div>
                        <button data-dismiss="modal" id="croppie-certificates-cancel-btn" type="button"
                                class="btn btn-secondary"><i
                                class="fas fa-times"></i></button>
                        <button id="croppie-certificates-submit-btn" type="button" class="btn btn-primary"><i
                                class="fas fa-crop"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $('select[name="category_id"]').on('change', function () {
            var CategoryId = $(this).val();
            if (CategoryId) {
                console.log(CategoryId);
                $.ajax({
                    url: "{{ URL::to('dashboard/category') }}/" + CategoryId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="sub_category_id"]').empty();
                        for (let i = 0; i <= data.length; i++) {
                            $('select[name="sub_category_id"]').append('<option value="' +
                                data[i].id + '">' + data[i].name + '</option>');
                        }
                        // $.each(data, function(key, value) {
                        //         $('select[name="sub_category_id"]').append('<option value="' +
                        //             key + '">' + value + '</option>');
                        //     });
                        // $.each(data, function(key, value) {
                        //     $('select[name="sub_category_id"]').append('<option value="' +
                        //         data.id + '">' + data.name + '</option>');
                        // });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        const fileInputImages = document.querySelector('#file-input-images');
        const previewImagesContainer = document.querySelector('.preview-images-container');
        const croppieModal = document.querySelector('#croppie-modal');
        const croppieContainer = document.querySelector('#croppie-container');
        const croppieCancelBtn = document.querySelector('#croppie-cancel-btn');
        const croppieSubmitBtn = document.querySelector('#croppie-submit-btn');
        fileInputImages.addEventListener('change', () => {
            let files = Array.from(fileInputImages.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);

                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            // if (window.confirm('Are you sure you want to delete this image?')) {
                            //     files.splice(file, 1)
                            //     preview.remove();
                            //     getImages()
                            // }
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getImages()
                                }
                            });
                        });

                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#imagesModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchImagesCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewImagesContainer.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }
            getImages()
        });

        function launchImagesCropTool(img) {
            // Set up Croppie options
            const croppieOptions = {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square' // or 'square'
                },
                boundary: {
                    width: 300,
                    height: 300,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            const croppie = new Croppie(croppieContainer, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieModal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieCancelBtn.addEventListener('click', () => {
                croppieModal.style.display = 'none';
                $('#imagesModal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieSubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                        width: 800,
                        height: 600
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieModal.style.display = 'none';
                    $('#imagesModal').modal('hide');
                    croppie.destroy();
                    getImages()
                });
            });
        }

        function getImages() {
            $("#cropped_images").empty();
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-images-container');
                let images = [];
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "cropImages[]").val(container[0].children[i].children[0].src);
                    $("#cropped_images").append(newInput);
                }
                console.log(images)
                return images
            }, 500);
        }
    </script>
    <script>
        const fileInputCertificates = document.querySelector('#file-input-certificates');
        const previewCertificatesContainer = document.querySelector('.preview-certificates-container');
        const croppieCertificatesModal = document.querySelector('#croppie-certificates-modal');
        const croppieCertificatesContainer = document.querySelector('#croppie-certificates-container');
        const croppieCertificatesCancelBtn = document.querySelector('#croppie-certificates-cancel-btn');
        const croppieCertificatesSubmitBtn = document.querySelector('#croppie-certificates-submit-btn');
        fileInputCertificates.addEventListener('click', () => {
            getCertificatesImages()
        });
        fileInputCertificates.addEventListener('change', () => {
            let files = Array.from(fileInputCertificates.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);

                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('button');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            // if (window.confirm('Are you sure you want to delete this image?')) {
                            //     files.splice(file, 1)
                            //     preview.remove();
                            //     getCertificatesImages()
                            // }
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getImages()
                                }
                            });
                        });

                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('button');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#certificatesModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchCertificatesCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewCertificatesContainer.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }
            getCertificatesImages()
        });

        function launchCertificatesCropTool(img) {
            // Set up Croppie options
            const croppieOptions = {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square' // or 'square'
                },
                boundary: {
                    width: 300,
                    height: 300,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            const croppie = new Croppie(croppieCertificatesContainer, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieCertificatesModal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieCertificatesCancelBtn.addEventListener('click', () => {
                croppieCertificatesModal.style.display = 'none';
                $('#certificatesModal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieCertificatesSubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                        width: 800,
                        height: 600
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieCertificatesModal.style.display = 'none';
                    $('#certificatesModal').modal('hide');
                    croppie.destroy();
                    getCertificatesImages()
                });
            });
        }

        function getCertificatesImages() {
            setTimeout(() => {
                $("#cropped_certificates_images").empty();
                const container = document.querySelectorAll('.preview-certificates-container');
                let images = [];
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src);
                    console.log(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "cropCertificateImages[]").val(container[0].children[i].children[0].src);
                    $("#cropped_certificates_images").append(newInput);
                }
                return images
            }, 500);

        }
    </script>

    <script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>

    <script>
        $("#product-images").fileinput({
            // theme: "bs5",
            // maxFileCount: 15,
            // allowedFileTypes: ['image'],
            // showCancel: true,
            // showUpload: false,
            // showRemove: false,
            // overwriteInitial: false,
            // initialPreviewAsData: true,
            // maxFileSize: 10000,
            // removeFromPreviewOnError: true,
            // browseOnZoneClick:true,
            // showBrowse:false,
            // initialPreviewAsData: true,
            // initialPreviewDownloadUrl: 'https://picsum.photos/id/{key}/1920/1080'
            // theme: "bs5",
            // uploadUrl: "/file-upload-batch/2",
            uploadUrl: "{{ route('admin.products.upload_image', ['_token' => csrf_token()]) }}",
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'svg'],
            overwriteInitial: false,
            initialPreviewAsData: true,
            maxFileSize: 10000,
            removeFromPreviewOnError: true,
            showUpload: false,
            // maxFileCount: 15,
            // allowedFileTypes: ['image'],
            // showCancel: true,
            // showRemove: true,
            initialPreview: [],
            initialPreviewConfig: [],
        });
        $("#product-images-ser").fileinput({
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
