@extends('layouts.website.master')
@section('title',trans('custom.mediation_request'))

@section('css')
    <link rel="stylesheet" href="{{ asset('website/css/intlTelInput.min.css') }}">

@stop

@section('content')
<div class="mediation_request p-5">
    <div class="container">
        <form action="{{route('post_mediation_request')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{trans('custom.client_name')}}</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{trans('custom.company_name')}}</label>
                        <input type="text" name="company_name" class="form-control">
                        @error('name')
                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{trans('custom.country')}}</label>
                        <input type="text" name="country_address" class="form-control">
                        @error('country')

                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    <label>{{trans('custom.country_code')}}</label>
                    <div class="form-group">
                        <input value="{{old('phone')}}" id="phone" name="phone" type="text" class="form-control"
                               onkeydown="return false"/>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    <label>{{trans('custom.phone')}}</label>
                    <div class="form-group">
                        <input name="phone2" type="tel" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                        @error('phone2')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>{{trans('custom.email')}}</label>
                        <input type="email" name="email" class="form-control" value="@if(auth('company')->user()) {{auth('company')->user()->email}} @endif">
                        @error('email')
                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid #EEE">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{trans('custom.company_name')}}</label>

                        <select class="form-control" name="company_id">

                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                            <option value="other">Other Company</option>
                        </select>
                        @error('company_id')
                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
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
            </div>
            <div class="row">
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
            </div>
            <div class="row">
                <div class="col-md-12">

                    <label>{{trans('custom.details')}}</label>
                    <textarea class="form-control" name="details"></textarea>
                    @error('details')
                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="{{trans('custom.send')}}">

                    </div>
                </div>
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

