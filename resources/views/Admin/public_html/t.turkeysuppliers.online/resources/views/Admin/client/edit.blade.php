@extends('Admin.layouts.master')
@section('title', __('company.buyer'))
@section('css')

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('website/css/intlTelInput.min.css') }}">
{{-- <style>
    .kv-file-upload{
        display: none;
    }
</style> --}}
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
                                    <h4 class="card-title" id="basic-layout-form">{{ __('company.buyer') }}</h4>
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
                                        <form class="form" action="{{ route('admin.clients.update', $company->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ $company->id }}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('company.name') }}</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ old('name',$company->name) }}"
                                                                placeholder="{{ __('company.name') }}">
                                                        </div>
                                                        @error('name')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
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
                                                        'data' => $company,
                                                    ])
                                                </div>
                                                {{-- <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('company.desc') }}</label>

                                                            <input type="text" class="form-control tinymce" name="description"
                                                                value="{!! old('description',$company->description) !!}"
                                                                placeholder="{{ __('company.desc') }}">
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
                                                    ])
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('company.email') }} </label>
                                                            <input type="text" class="form-control" name="email"
                                                                value="{{ old('email',$company->email) }}" placeholder="Email">
                                                        </div>
                                                        @error('email')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('admins.password') }}</label>
                                                            <input type="password" id="projectinput2" class="form-control"  name="password" value="{{ old('password') }}" placeholder="password">
                                                        </div>
                                                        @error('password')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>{{ __('admins.password_confirmation') }}<span class="text-danger">*</span></label>
                                                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" >
                                                            @error('password_confirmation')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('product.choose') }}</label>
                                                            <select class="form-control select2" name="plan_id">
                                                                <option value="" disabled>{{ __('product.choose') }}</option>
                                                                    @foreach ($plans as $plan)
                                                                        <option value="{{ $plan->id }}"
                                                                            {{ old('plan_id',$company->plan_id) == $plan->id ?'selected':null }} >
                                                                            {{ $plan->title }}
                                                                        </option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                        @error('plan_id')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div> --}}
                                                    {{-- <div class="col-md-6">
                                                        <div class="col-md-6" style="position: absolute;top: 0px;right: 121px;">
                                                            <input name="phone" type="tel" class="form-control" value="{{ $company->phone }}"
                                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="{{ __('company.phone') }}"/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input value="{{ old('cod') }}" id="phone"
                                                                name="cod"  type="text" class="form-control"
                                                                onkeydown="return false" />
                                                            @error('phone')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <span style="font-weight: bold;color: #0b1ce9;">{{ __('company.sms') }}</span>
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> {{ __('company.phone') }}</label>
                                                            <div class="row">
                                                                {{-- <div class="col-md-2">
                                                                    <input type="tel" class="form-control" name="cod"
                                                                    value="{{ old('cod',$company->cod)}}"    />
                                                                </div> --}}
                                                                <div class="col-md-10">
                                                                    <input type="tel" class="form-control" name="phone"
                                                                        value="{{ old('phone',$company->phone)}}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                                </div>
                                                                {{-- <span style="font-weight: bold;color: #0b1ce9;">{{ __('company.sms') }}</span> --}}
                                                            </div>
                                                        </div>
                                                        @error('phone')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> {{ __('company.phone1') }}</label>
                                                            <input type="tel" class="form-control" name="phone1"
                                                                value="{{ old('phone1',$company->phone1) }}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </div>
                                                        @error('phone1')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> {{ __('company.phone2') }}</label>
                                                            <input type="tel" class="form-control" name="phone2"
                                                                value="{{ old('phone2',$company->phone2) }}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </div>
                                                        @error('phone2')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> {{ __('company.phone3') }}</label>
                                                            <input type="tel" class="form-control" name="phone3"
                                                                value="{{ old('phone3',$company->phone3) }}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </div>
                                                        @error('phone3')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <label for="country">{{ trans('custom.country_region') }}</label>
                                                        <select required="required" name="country"id="country"
                                                            class="country form-control select2 @error('country') is-invalid @enderror">
                                                            <option value="" >---choose---</option>
                                                            @include('Admin.company.country2')
                                                        </select>
                                                        @error('country')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('company.image') }}</label>
                                                    <div class="file-loading">
                                                        <input type="file" id="company-images" class="form-control file-input-overview" name="images[]" multiple />
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
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
    <script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script> --}}
    <script>
         $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        $(function(){
            $("#company-images").fileinput({
                    // theme: "bs5",
                    uploadUrl: "{{ route('admin.companies.upload_image')}}",
                    uploadAsync: true,
                    minFileCount: 1,
                    maxFileCount: 50,
                    overwriteInitial: true,
                    data: {'_token': "{{csrf_token()}}"},
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: true,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: [
                        @if($company->media()->count() > 0)
                            @foreach($company->media as $media)
                                "{{ asset('images/companies/' . $media->file_name) }}",
                            @endforeach
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if($company->media()->count() > 0)
                            @foreach($company->media as $media)
                                {
                                    caption: "{{ $media->file_name }}",
                                    size: '{{ $media->file_size }}',
                                    width: "120px",
                                    url: "{{ route('admin.companies.remove_image', ['image_id' => $media->id, 'company_id' => $company->id, '_token' => csrf_token()]) }}",
                                    key: {{ $media->id }}
                                },
                            @endforeach
                        @endif
                    ]
                }).on('filesorted', function (event, params) {
                    console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
                });
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
        geoIpLookup: function(callback) {
          $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            callback(countryCode);
          });
        },
        hiddenInput: "full_number",
        initialCountry: "tr",
        // localizedCountries: { 'tr': 'Turkey' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
        utilsScript: "{{ asset('website/js/utils.js') }}",
    });
</script>
@endpush
