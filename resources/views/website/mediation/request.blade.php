@extends('layouts.website.master')
@section('title',trans('custom.mediation_request'))

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>

@stop

@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="{{route('mediation')}}"> {{trans('custom.Mediation')}} </a>
            /
            <a  class="cl6" href="#">  {{trans('custom.mediation_request')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-23 p-b-140">
    
        <div class="p-b-10 separator">
            <div class="flex-center bg1 p-0  b-rt-lb-20">
                <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                    {{trans('custom.mediation_request')}}
                </h3>
            </div>
        </div>
    <div class="container">
        <div class="p-b-10 p-t-40 ">
            <form action="{{route('post_mediation_request')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mtext-1075">
                            <label>{{trans('custom.client_name')}}</label>
                            <input type="text" name="name" class="form-control bg-input1">
                            @error('name')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mtext-1075">
                            <label>{{trans('custom.company_name')}}</label>
                            <input type="text" name="company_name" class="form-control bg-input1">
                            @error('name')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mtext-1075">
                            <label>{{trans('custom.country')}}</label>
                            <input type="text" name="country_address" class="form-control bg-input1">
                            @error('country')

                            <p class="text-danger" >{{ $message }}</p>
                            @enderror
                        </div>
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
                  
                    <div class="col-md-6">
                        <div class="form-group mtext-1075">
                            <label>{{trans('custom.email')}}</label>
                            <input type="email" name="email" class="form-control bg-input1" value="@if(auth('company')->user()) {{auth('company')->user()->email}} @endif">
                            @error('email')
                            <p class="text-danger" >{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                    <hr class="bg1 hr-c m-t-40 m-b-40">   
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mtext-1075">
                            <label>{{trans('custom.company_name')}}</label>

                            <select class="form-control bg-input1 p-0" name="company_id">

                                @foreach($companies as $company)
                                    <option   value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                                <option value="other">Other</option>
                            </select>
                            @error('company_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mtext-1075">
                            <label>{{trans('custom.product_name')}}</label>

                            <select class="form-control select2 bg-input1 p-0" name="product_id">

                            </select>
                            @error('product_id')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-6 p-l-0">
                            <div class="form-group  mtext-1075">
                                <label>{{trans('custom.qty')}}</label>
                                <input type="number" name="qty" class="form-control  bg-input1">
                                @error('qty')
                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group  mtext-1075">
                            <label>{{trans('custom.supply_period')}}</label>
                            <input type="text" name="supply_period" class="form-control  bg-input1">
                            @error('supply_period')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12  mtext-1075">

                        <label>{{trans('custom.details')}}</label>
                        <textarea class="form-control  bg-input1" name="details" rows="4"></textarea>
                        @error('details')
                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2 p-t-30">
                    <div class="col-md-12 txt-center">
                        <div class="form-group mtext-1075">
                            <input type="submit" class="btn bg-btn1" value="{{trans('custom.send')}}">

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>




@stop

@section('js')
    <script src="{{asset('website/js/jquery-3.4.1.js')}}"></script>
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

