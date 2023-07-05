@extends('layouts.website.master')
@section('title',trans('custom.translation_services_request'))
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>

@stop
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="{{route('translationServices')}}"> {{trans('custom.translationServices')}} </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.translation_services_request')}}</a>
        </p>
    </div>
</div>

<section class="bg0 p-t-23 p-b-140">
        <div class="p-b-10 separator">
            <div class="flex-center bg1 p-0  b-rt-lb-20">
                <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                    {{trans('custom.translation_services_request')}}
                </h3>
            </div>
        </div>
    <div class="container">
        <div class="p-b-10 p-t-40 ">
            <form  class="form" action="{{ route('postTranslationServices') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group mtext-1075">
                                <label for="projectinput1">{{ __('translationServices.companyname') }}</label>
                                @if(auth('company')->user())
                                    <input required="required" type="text" id="projectinput1" class="form-control bg-input1" name="name"
                                           value="{{auth('company')->user()->name}}" placeholder="{{ __('translationServices.companyname') }}">
                                @else
                                <input required="required" type="text" id="projectinput1" class="form-control bg-input1" name="name"
                                       value="{{old('name') }}" placeholder="{{ __('admins.name') }}">
                                @endif
                            </div>
                            @error('name')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mtext-1075">
                                <label for="projectinput2">{{ __('translationServices.language') }}</label>
                                <select name="language" class="form-control bg-input1 p-0" required="required">
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
                        <div class="col-md-6">
                            <div class="form-group  mtext-1075">
                                <label for="projectinput2">{{ __('translationServices.email') }}</label>
                                @if(auth('company')->user())
                                <input required="required" type="text" id="projectinput2" class="form-control bg-input1 "  name="email"
                                       value="{{auth('company')->user()->email}}" placeholder="{{ __('translationServices.email') }}">
                                @else
                                    <input required="required" type="text" id="projectinput2" class="form-control bg-input1 "  name="email"
                                           value="{{ old('email') }}" placeholder="{{ __('translationServices.email') }}">
                                @endif
                            </div>
                            @error('email')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-6  mtext-1075">
                            <label>{{ trans('custom.tel') }} </label>
                            <div class="row">
                                <div class="col-9 form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <input type="tel" required name="phone_number[main]" id="phone_number" class="form-control bg-input1">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr class="bg1 hr-c m-t-40 m-b-40">   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mtext-1075">
                                <label for="projectinput1">{{ __('translationServices.tocompanyname') }}</label>
                                <select name="company_id" class="form-control  bg-input1 p-0">
                                    <option value="" selected disabled readonly>{{ __('translationServices.choose') }}</option>
                                    @forelse(App\Models\Company::get() as $company)
                                        <option value="{{ $company->id }}"
                                            {{ old('company_id')==$company->id?'selected':null }} >
                                            {{ $company->name }}
                                        </option>
                                    @empty
                                    @endforelse
                                    <option value="other">Other</option>
                                </select>
                                {{-- @error('company_id')<span class="text-danger">{{ $message }}</span>@enderror --}}
                            </div>
                            @error('company_id')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mtext-1075">
                                <label>{{trans('custom.product_name')}}</label>
                                <select class="form-control select2 bg-input1" name="product_id">
                                </select>
                                @error('product_id')
                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6 p-l-0">
                                <div class="form-group mtext-1075">
                                    <label>{{trans('custom.qty')}}</label>
                                    <input type="number" name="qty" class="form-control bg-input1">
                                    @error('qty')
                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mtext-1075">
                                <label>{{trans('custom.supply_period')}}</label>
                                <input type="text" name="supply_period" class="form-control bg-input1">
                                @error('supply_period')
                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mtext-1075">
                                <label for="projectinput1">{{ __('translationServices.tocompanytopic') }}</label>
                                <textarea id="" cols="30" rows="4" name="notes" class="form-control bg-input1">
                                                        </textarea>
                            </div>
                            @error('notes')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-actions mtext-1075  txt-center">
                    <button type="submit" class="btn bg-btn1">
                        {{trans('custom.send')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>


@stop
@section('js')
    <script src="{{asset('website/js/jquery-3.4.1.js')}}"></script>
    <script src="{{ asset('website/js/intlTelInput.min.js') }}"></script>
    <script>
    $('select[name="product_id"]').on('click', function() {
            if($('select[name="company_id"]').val()==='other'){
                $('select[name="product_id"]').empty();
                $('select[name="product_id"]').append("<option value='other'>Other</option>");
            }
        });
        $('select[name="company_id"]').on('change', function() {
            let CompanyId = $(this).val();
            if (CompanyId) {
                $.ajax({
                    url: "{{ URL::to('company') }}/" + $(this).val(),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="product_id"]').empty();
                        console.log(typeof data);
                        for (let i =0;i<= data.length;i++){
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script>
    var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
    separateDialCode: true,
    preferredCountries:["in"],
    hiddenInput: "full",
    initialCountry: "tr",
    utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

    $("form").submit(function() {
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone_number[full]'").val(full_number);
    });
</script>

@stop
