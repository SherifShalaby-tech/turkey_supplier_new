@extends('Admin.layouts.master')
@section('title', __('company.newcompany'))
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/themes/bs5/theme.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <style>
        .preview-container {
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
    <style>
        .kv-file-upload{
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('website/css/intlTelInput.min.css') }}">
    <style>
        .preview-container {
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
            height: auto;
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
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{ __('company.newcompany') }}</h4>
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
                                        <form enctype="multipart/form-data" class="form"
                                            action="{{ route('admin.companies.store') }}" method="post">
                                            @csrf
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('company.name') }}</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name') }}"
                                                            placeholder="{{ __('company.name') }}">
                                                    </div>
                                                    @error('name')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                        type="button" data-toggle="collapse"
                                                        data-target="#translation_table_company" aria-expanded="false"
                                                        aria-controls="collapseExample">
                                                        {{ __('company.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_inputs', [
                                                        'attribute' => 'name',
                                                        'translations' => [],
                                                        'type' => 'company',
                                                    ])
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('company.desc') }}</label>
                                                        <input type="text" class="form-control tinymce"
                                                            name="description" value="{{ old('description') }}"
                                                            placeholder="{{ __('company.desc') }}">
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
                                            <div class="form-group col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('company.email') }}</label>
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ old('email') }}"
                                                        placeholder="{{ __('company.email') }}">
                                                </div>
                                                @error('email')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ __('product.choose') }}</label>
                                                    <select class="form-control select2" name="plan_id">
                                                        <option value="" disabled>{{ __('product.choose') }}</option>
                                                        @isset($plans)
                                                            @foreach ($plans as $plan)
                                                                <option value="{{ $plan->id }}" {{ old('plan_id')== $plan->id?'selected':null  }}>
                                                                    {{ $plan->title }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                @error('plan_id')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-6" style="position: absolute;top: 0px;right: 121px;">
                                                            <input name="phone" type="tel" class="form-control" value="{{ old('phone') }}"
                                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="{{ __('company.phone') }}"/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input value="{{ old('cod') }}"
                                                            {{-- id="phone" --}}
                                                                name="cod" type="tel" class="form-control"
                                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                                {{-- onkeydown="return false" --}}
                                                                />
                                                        </div>
                                                        @error('phone')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <span style="font-weight: bold;color: #0b1ce9;">{{ __('company.sms') }}</span>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('company.phone') }}</label>
                                                            <input type="tel" class="form-control" name="phone"
                                                                id="phone" value="{{ old('phone') }}"
                                                                placeholder="{{ __('company.phone') }}" />
                                                        </div>
                                                        <span
                                                            style="font-weight: bold;color: #0b1ce9;">{{ __('company.sms') }}</span>
                                                        @error('phone')
                                                            <p class="text-danger" style="font-size: 12px">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('company.phone1') }}</label>
                                                            <input type="tel" class="form-control" name="phone1"
                                                                value="{{ old('phone1') }}"
                                                                placeholder="{{ __('company.phone1') }}"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </div>
                                                        @error('phone1')
                                                            <p class="text-danger" style="font-size: 12px">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('company.phone2') }}</label>
                                                            <input type="tel" class="form-control" name="phone2"
                                                                value="{{ old('phone2') }}"
                                                                placeholder="{{ __('company.phone2') }}"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </div>
                                                        @error('phone2')
                                                            <p class="text-danger" style="font-size: 12px">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('company.phone3') }}</label>
                                                            <input type="tel" class="form-control" name="phone3"
                                                                value="{{ old('phone3') }}"
                                                                placeholder="{{ __('company.phone3') }}"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </div>
                                                        @error('phone3')
                                                            <p class="text-danger" style="font-size: 12px">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-6">
                                                    <label for="country">{{ trans('custom.country_region') }}</label>
                                                    <select required="required" name="country"id="country"
                                                        class="country form-control select2 @error('country') is-invalid @enderror">
                                                        <option value="" disabled>---choose---</option>
                                                        @include('Admin.company.country')
                                                    </select>
                                                    @error('country')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ __('admins.password') }}</label>
                                                        <input type="password" id="projectinput2" class="form-control"
                                                            name="password" value="{{ old('password') }}"
                                                            placeholder="{{ __('admins.password') }}">
                                                    </div>
                                                    @error('password')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('admins.password_confirmation') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control"
                                                            value="{{ old('password_confirmation') }}">
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('company.images') }}</label>
                                                    <div class="container mt-3">
                                                        <div class="row mx-0" style="border: 1px solid #ddd;padding: 30px 0px;">
                                                            <div class="col-12">
                                                                <div class="mt-3">
                                                                    <div class="row">
                                                                        <div class="col-10 offset-1">
                                                                            <div class="variants">
                                                                                <div class='file file--upload w-100'>
                                                                                    <label for='file-input' class="w-100">
                                                                                        <i class="fas fa-cloud-upload-alt"></i>Upload
                                                                                    </label>
                                                                                    <!-- <input  id="file-input" multiple type='file' /> -->
                                                                                    <input type="file" multiple id="file-input">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-10 offset-1">
                                                                <div class="preview-container"></div>
                                                            </div>
                                                        </div>
                                                    </div>
{{--                                                    <div class="file-loading">--}}
{{--                                                        <input type="file" id="company-images"--}}
{{--                                                            class="form-control file-input-overview @error('images') is-invalid @enderror"--}}
{{--                                                            name="images[]"--}}
{{--                                                            multiple accept="image" />--}}
{{--                                                    </div>--}}
                                                </div>
                                                @error('images')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('admins.save') }}
                                                </button>
                                            </div>
                                            <div id="cropped_images"></div>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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

@endsection


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        const fileInput = document.querySelector('#file-input');
        const previewContainer = document.querySelector('.preview-container');
        const croppieModal = document.querySelector('#croppie-modal');
        const croppieContainer = document.querySelector('#croppie-container');
        const croppieCancelBtn = document.querySelector('#croppie-cancel-btn');
        const croppieSubmitBtn = document.querySelector('#croppie-submit-btn');

        // let currentFiles = [];
        fileInput.addEventListener('change', () => {
            // previewContainer.innerHTML = '';
            let files = Array.from(fileInput.files)
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
                        cropBtn.setAttribute("data-target", "#exampleModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', (e) => {
                            e.preventDefault();
                            setTimeout(() => {
                                launchCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewContainer.appendChild(preview);
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

            getImages()
        });
        function launchCropTool(img) {
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
                $('#exampleModal').modal('hide');
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
                    $('#exampleModal').modal('hide');
                    croppie.destroy();
                    getImages()
                });
            });
        }

        function getImages() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-container');
                let images = [];
                $("#cropped_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "cropImages[]").val(container[0].children[i].children[0].src);
                    $("#cropped_images").append(newInput);
                }
                return images
            }, 300);
        }

    </script>
    {{-- <script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script> --}}
    <script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script>
    <script>
        $("#company-images").fileinput({
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
            uploadUrl: "{{ route('admin.companies.upload_image', ['_token' => csrf_token()]) }}",
            allowedFileExtensions: ['jpg', 'png', 'gif','jpeg','svg'],
            overwriteInitial: false,
            initialPreviewAsData: true,
            maxFileSize: 10000,
            removeFromPreviewOnError: true,
            // maxFileCount: 15,
            // allowedFileTypes: ['image'],
            // showCancel: true,
            // showRemove: true,
            showUpload: false,
            initialPreview: [

            ],
            initialPreviewConfig: [

            ],
        });
    </script>

    <script src="{{ asset('website/js/intlTelInput.min.js') }}"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // allowDropdown: false,
            autoHideDialCode: true,
            autoPlaceholder: "off",
            // dropdownContainer: document.body,
            //  excludeCountries: ["TR"],
            formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            hiddenInput: "full_number",
            initialCountry: "tr",
            // localizedCountries: { 'tr': 'Turkey' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "{{ asset('website/js/utils.js') }}",
        });
    </script>
@endpush
