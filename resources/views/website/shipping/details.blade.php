@extends('layouts.website.master')
@section('title', $shipping->name)
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
@stop

@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.shipping')}} </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.Read-More')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-45 p-b-120">
    <div class="container-fluid">


            <div class="row p-b-70">

                <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                    <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                        <div class=" block2  ">
                            <div class="block2-pic hov-img0">
                                <img src="{{asset('website/imgs/shipping/air_freight.png')}}" alt="Card image cap"
                                    style="
                                    border-radius: 30px; right:0;">
                            </div>
                            <p class="txt-center mtext-1035 p-tb-20  m-t-20 m-b-20 btn-red btn cl0" style="display: flex; text-align: center; justify-content: center;"
                            >{{trans('custom.basic_shipping_services')}}</p>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12 txt-start m-t-40">
                    <div class="p-tb-20 p-r-85 p-l-85 p-r-15-lg p-r-0-md p-l-0-md border-dot m-r-20 m-l-20">
                        <p class="mtext-108 cl2 p-b-26" style="line-height: 2.3;">
                            {!! $shipping->basic_shipping_service !!}

                        </p>
                    </div>
                </div>
            </div>
        <div class="col-12 col-md-12 col-lg-12 m-lr-auto txt-center p-t-0 ">
            <a href="#" class="btn bg1 cl0 mtext-108">{{trans('custom.request_quotation')}}</a>
        </div>

    </div>
</section>

<div>
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
        
        <div class="container">
            <div class="p-b-10 p-t-40 ">
                <form autocomplete="off" action="{{ route('shipping.new_order') }}" enctype="multipart/form-data"  method="POST" >
                    @csrf 
                    {{-- <x-message-admin /> --}}
                    <div class="row p-tb-50">
                            <div class="col-12 p-b-20 separator">
                                <div class="flex-center bg1 p-0  b-rt-lb-20">
                                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                                        {{trans('custom.your_info')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.your_name') }} *</label>
                                    <input type="text" id="name" class="form-control bg-input1" name="name"> <!-- required -->
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.email') }} </label>
                                    <input type="email" id="email" class="form-control bg-input1" name="email"> <!-- required -->
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.your_comapny') }}</label>
                                    <input type="text" id="companyname" class="form-control bg-input1" name="companyname">
                                    @error('companyname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.tel') }} </label>
                                    <div class="row">
                                        {{-- <div class="col-3 form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                            <input type="tel" id="code" name="code" class="form-control bg-input1">
                                            @error('code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        <div class="col-9 form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                            <input type="tel" name="phone_number[main]" id="phone_number" class="form-control bg-input1">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
    
                    <div class="row p-tb-50">
                            <div class="col-12 p-b-30 separator ">
                                <div class="flex-center bg1 p-0  b-rt-lb-20">
                                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                                        {{trans('custom.shipment_and_supplier_data')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.country') }}</label> <!-- كل الدول -->
                                    <select class="form-control select2 bg-input1 p-0" id="exampleFormControlSelect1" id="country"
                                    name="country">
                                        <option value="">--{{ trans('custom.select') }}--</option>
                                        @include('Admin.company.country')
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.supplier_email') }}</label>
                                    <input type="email" class="form-control bg-input1" id="vendoremail" name="vendoremail">
                                    @error('vendoremail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.supplier_name') }}</label>
                                    <input type="text" class="form-control bg-input1" id="vendorname" name="vendorname">
                                    @error('vendorname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.supplier_phone') }}</label> <!-- تليفون عادي مش بالدول -->
                                    <input type="number" class="form-control bg-input1" id="vendorphone" name="vendorphone">
                                    @error('vendorphone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label for="File">{{ trans('custom.upload_your_files') }} </label>
                                    <input type="file" class="form-control-file bg-input1" id="File" name="file">
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>  
    
    
                    <div class="row p-tb-50">
                            <div class="col-12 p-b-30 separator">
                                <div class="flex-center bg1 p-0  b-rt-lb-20">
                                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                                        {{trans('custom.request_quotation')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label for="Shipping way"> {{ trans('custom.shipping_way') }}</label>
                                    <select onchange="shippingFunction()" class="form-control bg-input1 p-0" id="shipment_name" name="shipment_name">
                                        <option value="">-- {{ trans('custom.select') }} --</option>
                                        <option value="air_freight">{{ trans('custom.air_freight') }}</option>
                                        <option value="sea_freight">{{ trans('custom.sea_freight') }}</option>
                                    </select>
                                    @error('shipment_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label for="Receiving Supplier"> {{ trans('custom.receiving_from_the_supplier') }}</label>
                                    <select onchange="shippingFunction()" class="form-control bg-input1 p-0" id="shipment_type" name="shipment_type">
                                        <option value="">-- {{ trans('custom.select') }} --</option>
                                        <option value="FOB">{{ trans('custom.FOB') }}</option>
                                        <option value="Ex-Factory">{{ trans('custom.Ex-Factory') }}</option>
                                    </select>
                                    @error('shipment_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif" >
                                    <label for="input unit"> {{ trans('custom.input_unit') }} </label>
                                    <select onchange="shippingFunction()" class="form-control bg-input1 p-0" id="unit" name="unit">
                                        <option value="" >-- {{ trans('custom.select') }} --</option>
                                        <option value="cm">{{ trans('custom.cm') }}</option>
                                        <option value="m">{{ trans('custom.m') }}</option>
                                        <option value="insh">{{ trans('custom.insh') }}</option>
                                        <option value="yard">{{ trans('custom.yard') }}</option>
                                    </select>
                                    @error('unit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="flex-c-m m-tb-20">
                                    <h5 class="btn-red p-tb-10 p-lr-70 cl0">{{ trans('custom.parcel_dimensions') }} </h5>
    
                                </div>
                            </div>
                            
                            <div class="col-12 flex-row">
                                <div class="col-4 mtext-1075">
                                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                        <label for="Length">{{ trans('custom.length') }}</label>
                                        <input onkeyup="shippingFunction()" type="number" class="input form-control bg-input1" id="length"
                                        name="length"  placeholder="ادخل الطول بالسنتيمنتر"
                                            value="0.00">
                                        @error('length')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="hidden" class="input form-control bg-input1" id="clength"
                                        name="clength" disabled>
                                    </div>    
                                </div>
                                <div class="col-4 mtext-1075">
                                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                        <label for="Width">{{ trans('custom.width') }} </label>
                                            <input type="number" onkeyup="shippingFunction()" class="input form-control bg-input1" id="width"
                                                name="width"  placeholder="ادخل العرض بالسنتيمتر"
                                                value="0.00">
                                            @error('width')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <input type="hidden" class="input form-control bg-input1" id="cwidth"
                                            name="cwidth" disabled>
                                    </div> 
                                </div>
                                <div class="col-4 mtext-1075">
                                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                        <label for="Height">{{ trans('custom.height') }} </label>
                                            <input type="number" onkeyup="shippingFunction()" class="input form-control bg-input1" id="height"
                                            name="height" 
                                                placeholder="ادخل الارتفاع بالسنتيمتر" value="0.00">
                                            @error('height')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <input type="hidden" class="input form-control bg-input1" id="cheight"
                                            name="cheight" disabled>
                                    </div>
                                </div>
    
                            </div>
                            <div class="col-12 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label for="input unit"> {{ trans('custom.dimensional_weight') }}</label>
                                    <input onkeyup="shippingFunction()" class="form-control bg-input1" type="text" value="" readonly id="dimensional_weight"
                                    name="dimensional_weight">
                                </div>
                            </div>
    
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label for="weightunit"> {{ trans('custom.weight_unit') }} </label>
                                    <select onchange="shippingFunction()" class="form-control bg-input1 p-0" id="weightunit" name="weightunit">
                                        <option value="">-- {{ trans('custom.select') }} --</option>
                                        <option value="kg">{{ trans('custom.Kg') }}</option>
                                        <option value="g">{{ trans('custom.g') }}</option>
                                        <option value="pound">{{ trans('custom.pound') }}</option>
                                        <option value="ounce">{{ trans('custom.ounce') }}</option>
                                    </select>
                                    @error('weightunit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-6 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label for="weight">{{ trans('custom.package_weight') }}</label>
                                    <div class="row">
                                        <input onkeyup="shippingFunction()" type="number" class="form-control bg-input1" id="weight"
                                        name="weight"  placeholder="" value="0.00">
                                        @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="hidden" class="form-control bg-input1" id="cweight"
                                        name="cweight" disabled>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-12 mtext-1075 p-tb-20">
                                <p  class="  flex-c-m p-tb-20 p-lr-50 b-rt-lb-20">{{ trans('custom.You_will_be_charged_based_on') }}
                                    <span id="based_on" style="color:red;font-weight:bold;">
                                        
                                    </span>
                                </p>
                            </div>
                            <div class="col-12 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif"
                                    style="padding-left: 0;">
                                    <label>{{ trans('custom.number_of_packages') }}</label>
    
                                    <input  onkeyup="shippingFunction()" type="number" class="form-control bg-input1" id="package_no" name="package_no" placeholder="">
                                    <!-- only number -->
                                    @error('package_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif"
                                    style="padding-left: 0;">
                                    <label>{{ trans('custom.shipment_destination') }}</label>
                                    <input type="text" class="form-control bg-input1" id="destination" name="destination" placeholder="">
                                    @error('destination')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mtext-1075">
                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                    <label>{{ trans('custom.details') }}</label>
                                    <textarea  id="details" class="form-control bg-input1" cols="30" rows="10"
                                    name="details">
                                            </textarea>
                                    @error('details')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                    </div>
    
                    <div class="form-actions mtext-1075  txt-center">
                        <button type="submit" id ="btnSubmit" class="btn bg-btn1">
                            {{trans('custom.send')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    function shippingFunction() {
      var shipment_name = $("select[name=shipment_name]").find(":selected").val();
      var shipment_type = $("select[name=shipment_type]").find(":selected").val();
      var unit = $("select[name=unit]").find(":selected").val();
      var length = +$("input[name=length]").val();
      var clength = +$("input[name=clength]").val();
      var width = +$("input[name=width]").val();
      var cwidth = +$("input[name=cwidth]").val();
      var height = +$("input[name=height]").val();
      var cheight = +$("input[name=cheight]").val();
            
            if(unit =='m'){
                clength = parseFloat(length) * 100 ?? null;
                cwidth  = parseFloat(width) * 100 ?? null;
                cheight = parseFloat(height) * 100 ?? null;
                // console.log(length);
            }else if(unit =='insh'){
                clength = parseFloat(length) * 2.54 ?? null;
                cwidth  = parseFloat(width)  * 2.54 ?? null;
                cheight =parseFloat(height) * 2.54 ?? null;
            }else if(unit =='yard'){
                clength = parseFloat(length) * 91.44 ?? null;
                cwidth  = parseFloat(width)  * 91.44 ?? null;
                cheight = parseFloat(height) * 91.44 ?? null;
            }else{
                clength = parseFloat(length) ?? null;
                cwidth  = parseFloat(width) ?? null;
                cheight = parseFloat(height) ?? null;
            }

            if(shipment_name == 'air_freight'){
                $("input[name=dimensional_weight]").val((parseFloat(clength) * parseFloat(cwidth) * parseFloat(cheight)) / 6000  ?? 0);
            }else if(shipment_name == 'sea_freight'){
                $("input[name=dimensional_weight]").val((parseFloat(clength) * parseFloat(cwidth) * parseFloat(cheight)) / 1000000  ?? 0);
            }else{
                $("input[name=dimensional_weight]").val('0.00') ;
            }
            $("input[name=weight]").keyup(function(){
                var weightunit = $("select[name=weightunit]").find(":selected").val();
                var weight = +$("input[name=weight]").val();
                var cweight = +$("input[name=cweight]").val();
                    if(weightunit =='pound'){
                        cweight = parseFloat(weight) * 0.45359 ?? null;
                    }else if(weightunit =='ounce'){
                        cweight = parseFloat(weight) * 0.0283495 ?? null;
                    }else if(weightunit =='g'){
                        cweight = parseFloat(weight) / 1000 ?? null;
                    }else{
                        cweight = parseFloat(weight) ?? null;
                    }
                var dimintiol_weight = $("input[name=dimensional_weight]").val()
                if(cweight > dimintiol_weight){
                    document.getElementById("based_on").innerHTML = " {{ trans('custom.cweight') }}";
                }else{
                    document.getElementById("based_on").innerHTML = " {{ trans('custom.dimensional_weight') }}";
                }
            });
            
    }
   
    
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
    {{-- <script>
        $(document).ready(function() {
            // initialize intl-tel-input
            $('#phone').intlTelInput({
                separateDialCode: true
            });

            // populate country dropdown
            var countryData = $.fn.intlTelInput.getCountryData();
            for (var i = 0; i < countryData.length; i++) {
                $('#country').append($('<option>', {
                    value: countryData[i].dialCode,
                    text: countryData[i].name
                }));
            }
        });
    </script> --}}
@stop
