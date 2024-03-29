@extends('Admin.layouts.master')
@section('title', __('company.buyer'))
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/themes/bs5/theme.css') }}">
    <style>
        .kv-file-upload{
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('website/css/intlTelInput.min.css') }}">
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
                                    <h4 class="card-title" id="basic-layout-form">{{ __('company.newbuyer') }}</h4>
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
                                            action="{{ route('admin.clients.store') }}" method="post">
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
                                            {{-- <div class="form-group col-md-12 mb-2">
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
                                            </div> --}}
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
                                            {{-- <div class="form-group col-md-6 mb-2">
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
                                            </div> --}}
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('company.phone') }}</label>
                                                            <input name="phone" type="tel" class="form-control" value="{{ old('phone') }}"
                                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="{{ __('company.phone') }}"/>
                                                        </div>
                                                        @error('phone')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        {{-- <span style="font-weight: bold;color: #0b1ce9;">{{ __('company.sms') }}</span> --}}
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
                                            {{-- <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('company.images') }}</label>
                                                    <div class="file-loading">
                                                        <input type="file" id="company-images"
                                                            class="form-control file-input-overview"
                                                            name="images[]"
                                                            multiple accept="image" />
                                                    </div>
                                                </div>
                                                @error('images')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                                                @enderror
                                            </div> --}}
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
