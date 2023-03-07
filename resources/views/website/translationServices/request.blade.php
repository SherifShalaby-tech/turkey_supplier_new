@extends('layouts.website.master')
@section('title',trans('custom.translation_services_request'))
@section('css')
    <link rel="stylesheet" href="{{ asset('website/css/intlTelInput.min.css') }}">

@stop
@section('content')
    <div class="mediation_request p-5">
        <div class="container">
            <form  class="form" action="{{ route('postTranslationServices') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="projectinput1">{{ __('admin.image') }}</label>--}}
{{--                                <input type="file" id="projectinput1" class="form-control" name="image" accept="image/*" >--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <img src="{{ asset('images/Logo.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">--}}
{{--                            </div>--}}
{{--                            @error('image')--}}
{{--                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput1">{{ __('translationServices.companyname') }}</label>
                                @if(auth('company')->user())
                                    <input required="required" type="text" id="projectinput1" class="form-control" name="name"
                                           value="{{auth('company')->user()->name}}" placeholder="{{ __('translationServices.companyname') }}">
                                @else
                                <input required="required" type="text" id="projectinput1" class="form-control" name="name"
                                       value="{{old('name') }}" placeholder="{{ __('admins.name') }}">
                                @endif
                            </div>
                            @error('name')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput2">{{ __('translationServices.language') }}</label>
                                <select name="language" class="form-control" required="required">
                                    <option value="" disabled readonly selected>{{ __('translationServices.chooselang') }}</option>
                                    <option value="ar" {{ old('language') == 'ar' ? 'selected' : null }}>{{ __('translationServices.arabic') }}</option>
                                    <option value="en" {{ old('language') == 'en' ? 'selected' : null }}>{{ __('translationServices.english') }}</option>
                                    <option value="fr" {{ old('language') == 'fr' ? 'selected' : null }}>{{ __('translationServices.french') }}</option>
                                    <option value="tr" {{ old('language') == 'tr' ? 'selected' : null }}>{{ __('translationServices.turkey') }}</option>
                                </select>
                            </div>
                            @error('language')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="projectinput1">{{ __('translationServices.companyname') }}</label>--}}
{{--                                <input type="text" id="projectinput1" class="form-control" name="companyname"--}}
{{--                                       value="{{ old('companyname') }}" placeholder="{{ __('translationServices.companyname') }}">--}}
{{--                            </div>--}}
{{--                            @error('companyname')--}}
{{--                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <div class="col-2">
                            <label>{{trans('custom.country_code')}}</label>
                            <div class="form-group">
                                <input value="{{old('country_code')}}" id="phone" name="country_code" type="text" class="form-control"
                                       onkeydown="return false"/>
                                @error('country_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <label>{{trans('custom.phone')}}</label>
                            <div class="form-group">
                                @if(auth('company')->user())
                                    <input value="{{auth('company')->user()->phone}}" name="phone" type="tel" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                                @else
                                    <input value="{{old('phone')}}" name="phone" type="tel" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                                @endif
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput2">{{ __('translationServices.email') }}</label>
                                @if(auth('company')->user())
                                <input required="required" type="text" id="projectinput2" class="form-control"  name="email"
                                       value="{{auth('company')->user()->email}}" placeholder="{{ __('translationServices.email') }}">
                                @else
                                    <input required="required" type="text" id="projectinput2" class="form-control"  name="email"
                                           value="{{ old('email') }}" placeholder="{{ __('translationServices.email') }}">
                                @endif
                            </div>
                            @error('email')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput1">{{ __('translationServices.tocompanyname') }}</label>
                                <select name="company_id" class="form-control">
                                    <option value="" selected disabled readonly>{{ __('translationServices.choose') }}</option>
                                    @forelse(App\Models\Company::get() as $company)
                                        <option value="{{ $company->id }}"
                                            {{ old('company_id')==$company->id?'selected':null }} >
                                            {{ $company->name }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                {{-- @error('company_id')<span class="text-danger">{{ $message }}</span>@enderror --}}
                            </div>
                            @error('company_id')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('custom.product_name')}}</label>

                                <select class="form-control select2" name="product_id">


                                </select>
                                @error('product_id')
                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('custom.qty')}}</label>
                                <input type="number" name="qty" class="form-control">
                                @error('qty')
                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('custom.supply_period')}}</label>
                                <input type="text" name="supply_period" class="form-control">
                                @error('supply_period')
                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1">{{ __('translationServices.tocompanytopic') }}</label>
                                <textarea id="" cols="30" rows="10" name="notes" class="form-control">
                                                        </textarea>
                            </div>
                            @error('notes')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
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


@stop
@section('js')
    <script src="{{asset('website/js/jquery-3.4.1.js')}}"></script>
    <script src="{{ asset('website/js/intlTelInput.min.js') }}"></script>
    <script>
        $('select[name="company_id"]').on('change', function() {
            let CompanyId = $(this).val();
            if (CompanyId) {
                $.ajax({
                    url: "{{ URL::to('company') }}/" + CompanyId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="product_id"]').empty();
                        console.log(typeof data);
                        for (let i =1;i<= data.length;i++){
                            $('select[name="product_id"]').append('<option value="' +
                                data[i].id + '">' + data[i].name + '</option>');
                        }
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
    <script>
        let input = document.querySelector("#phone");
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
            separateDialCode: true,
            utilsScript: "{{ asset('website/js/utils.js') }}",
        });
    </script>

@stop
