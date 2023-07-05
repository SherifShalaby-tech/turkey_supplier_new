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
                <form autocomplete="off" wire:submit.prevent='submit' wire:ignore.self>
                    @csrf
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
                                <input type="text" class="form-control" wire:model.lazy="name"> <!-- required -->
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                                            <div class="col-6 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label>{{ trans('custom.email') }} </label>
                                                    <input type="email" class="form-control bg-input1" wire:model.lazy="email"> <!-- required -->
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label>{{ trans('custom.your_comapny') }}</label>
                                                    <input type="text" class="form-control bg-input1" wire:model.lazy="companyname">
                                                    @error('companyname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label>{{ trans('custom.tel') }} </label>
                                                    <div class="row">
                                                        <div class="col-3 form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                            <input type="tel" wire:model.lazy="code" class="form-control bg-input1">
                                                            @error('code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-9 form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                            <input type="tel" wire:model.lazy="phone" class="form-control bg-input1">
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
                                                    <select class="form-control select2 bg-input1 p-0" id="exampleFormControlSelect1"
                                                            wire:model.lazy="country">
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
                                                    <input type="email" class="form-control bg-input1" wire:model.lazy="vendoremail">
                                                    @error('vendoremail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label>{{ trans('custom.supplier_name') }}</label>
                                                    <input type="text" class="form-control bg-input1" wire:model.lazy="vendorname">
                                                    @error('vendorname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label>{{ trans('custom.supplier_phone') }}</label> <!-- تليفون عادي مش بالدول -->
                                                    <input type="number" class="form-control bg-input1" wire:model.lazy="vendorphone">
                                                    @error('vendorphone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label for="File">{{ trans('custom.upload_your_files') }} </label>
                                                    <input type="file" class="form-control-file bg-input1" id="File" wire:model.lazy="file">
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
                                                    <select class="form-control bg-input1 p-0" id="exampleFormControlSelect1" wire:model.lazy="shipment_name"
                                                            wire:click.prevent="calculateNet">
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
                                                    <select class="form-control bg-input1 p-0" id="exampleFormControlSelect1" wire:model.lazy="shipment_type">
                                                        <option value="">-- {{ trans('custom.select') }} --</option>
                                                        <option value="FOB" selected>{{ trans('custom.FOB') }}</option>
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
                                                    <select class="form-control bg-input1 p-0" id="exampleFormControlSelect1" wire:model.lazy="unit"
                                                            wire:click.prevent="calculateNet">
                                                        <option value="" >-- {{ trans('custom.select') }} --</option>
                                                        <option value="cm" selected>{{ trans('custom.cm') }}</option>
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
                                                        <input type="number" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="length" wire:keyup="calculateNet" placeholder="ادخل الطول بالسنتيمنتر"
                                                               value="1.00">
                                                        @error('length')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <input type="hidden" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="clength" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-4 mtext-1075">
                                                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                        <label for="Width">{{ trans('custom.width') }} </label>
                                                        <input type="number" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="width" wire:keyup="calculateNet" placeholder="ادخل العرض بالسنتيمتر"
                                                               value="1.00">
                                                        @error('width')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <input type="hidden" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="cwidth" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-4 mtext-1075">
                                                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                        <label for="Height">{{ trans('custom.height') }} </label>
                                                        <input type="number" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="height" wire:keyup="calculateNet"
                                                               placeholder="ادخل الارتفاع بالسنتيمتر" value="1.00">
                                                        @error('height')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <input type="hidden" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="cheight" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label for="input unit"> {{ trans('custom.dimensional_weight') }}</label>
                                                    <input class="form-control bg-input1" type="text" value="" readonly
                                                           wire:model.lazy="dimensional_weight">
                                                </div>
                                            </div>

                                            <div class="col-6 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label for="weightunit"> {{ trans('custom.weight_unit') }} </label>
                                                    <select class="form-control bg-input1 p-0" id="exampleFormControlSelect1" wire:model.lazy="weightunit"
                                                            wire:click.prevent="calculateWeight">
                                                        <option value="">-- {{ trans('custom.select') }} --</option>
                                                        <option value="kg" selected>{{ trans('custom.Kg') }}</option>
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
                                                        <input type="number" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="weight" wire:keyup="calculateWeight" placeholder="" value="1.00"
                                                               wire:keyup="getResult">
                                                        @error('weight')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <input type="hidden" class="form-control bg-input1" id="exampleFormControlInput1"
                                                               wire:model.lazy="cweight" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mtext-1075 p-tb-20">
                                                <p class="  flex-c-m p-tb-20 p-lr-50 b-rt-lb-20">{{ trans('custom.You_will_be_charged_based_on') }}
                                                    <span style="color:red;font-weight:bold;">
                                                            @if ($cweight != '' && $dimensional_weight != '')
                                                            @if ($this->cweight > $this->dimensional_weight)
                                                                {{ trans('custom.cweight') }}
                                                            @else
                                                                {{ trans('custom.dimensional_weight') }}
                                                            @endif
                                                        @endif
                                                        </span>
                                                </p>
                                            </div>
                                            <div class="col-12 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif"
                                                     style="padding-left: 0;">
                                                    <label>{{ trans('custom.number_of_packages') }}</label>

                                                    <input type="number" class="form-control bg-input1" wire:model.lazy="package_no" placeholder="">
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
                                                    <input type="text" class="form-control bg-input1" wire:model.lazy="destination" placeholder="">
                                                    @error('destination')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 mtext-1075">
                                                <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                                    <label>{{ trans('custom.details') }}</label>
                                                    <textarea name="" id="" class="form-control bg-input1" cols="30" rows="10"
                                                              wire:model.lazy="details">
                                                                </textarea>
                                                    @error('details')
                                                    <span class="text-danger">{{ $message }}</span>
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

</div>
