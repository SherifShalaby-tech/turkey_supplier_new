<div>
    <div class="p-5 mt-3" >
        <div class="container-fluid">
            <form autocomplete="off" enctype="multipart/form-data" wire:submit.prevent='submit' method="POST" wire:ignore.self>
                @csrf
                {{-- <x-message-admin /> --}}
                <div class="row"  >
                    <div class="col-lg-6 col-sm-12">
                        <div class="inquiries_and_quotes">
                            <h3> {{ trans('custom.request_quotation') }}</h3>
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label for="Shipping way"> {{ trans('custom.shipping_way') }}</label>
                                <select class="form-control" id="exampleFormControlSelect1" wire:model.lazy="shipment_name"
                                   wire:click.prevent="calculateNet">
                                    <option value="">-- {{ trans('custom.select') }} --</option>
                                    <option value="air_freight">{{ trans('custom.air_freight') }}</option>
                                    <option value="sea_freight">{{ trans('custom.sea_freight') }}</option>
                                </select>
                                @error('shipment_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label for="Receiving Supplier"> {{ trans('custom.receiving_from_the_supplier') }}</label>
                                <select class="form-control" id="exampleFormControlSelect1" wire:model.lazy="shipment_type">
                                    <option value="">-- {{ trans('custom.select') }} --</option>
                                    <option value="FOB">{{ trans('custom.FOB') }}</option>
                                    <option value="Ex-Factory">{{ trans('custom.Ex-Factory') }}</option>
                                </select>
                                @error('shipment_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif" >
                                <label for="input unit"> {{ trans('custom.input_unit') }} </label>
                                <select class="form-control" id="exampleFormControlSelect1" wire:model.lazy="unit"
                                   wire:click.prevent="calculateNet">
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

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <h5>{{ trans('custom.parcel_dimensions') }} </h5>

                                <label for="Length">{{ trans('custom.length') }}</label>
                                <div class="row">
                                    <input type="number" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="length" wire:keyup="calculateNet" placeholder="ادخل الطول بالسنتيمنتر"
                                        value="0.00">
                                    @error('length')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="clength" disabled>
                                </div>

                                <label for="Width">{{ trans('custom.width') }} </label>
                                <div class="row">
                                    <input type="number" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="width" wire:keyup="calculateNet" placeholder="ادخل العرض بالسنتيمتر"
                                        value="0.00">
                                    @error('width')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="cwidth" disabled>
                                </div>

                                <label for="Height">{{ trans('custom.height') }} </label>
                                <div class="row">
                                    <input type="number" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="height" wire:keyup="calculateNet"
                                        placeholder="ادخل الارتفاع بالسنتيمتر" value="0.00">
                                    @error('height')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="cheight" disabled>
                                </div>
                            </div>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label for="input unit"> {{ trans('custom.dimensional_weight') }}</label>
                                <input class="form-control" type="text" value="" readonly
                                    wire:model.lazy="dimensional_weight">
                            </div>
                            <hr>
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label for="weightunit"> {{ trans('custom.weight_unit') }} </label>
                                <select class="form-control" id="exampleFormControlSelect1" wire:model.lazy="weightunit"
                                   wire:click.prevent="calculateWeight">
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
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label for="weight">{{ trans('custom.package_weight') }}</label>
                                <div class="row">
                                    <input type="number" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="weight" wire:keyup="calculateWeight" placeholder="" value="0.00"
                                        wire:keyup="getResult">
                                    @error('weight')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" class="form-control col-md-6" id="exampleFormControlInput1"
                                        wire:model.lazy="cweight" disabled>
                                </div>
                            </div>

                            <p>{{ trans('custom.You_will_be_charged_based_on') }}
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
                            {{-- <input type="number" class="form-control col-md-6" id="exampleFormControlInput1" wire:model.lazy="net_weight" disabled > --}}

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif"
                                style="padding-left: 0;">
                                <label>{{ trans('custom.number_of_packages') }}</label>

                                <input type="number" class="form-control" wire:model.lazy="package_no" placeholder="">
                                <!-- only number -->
                                @error('package_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif"
                                style="padding-left: 0;">
                                <label>{{ trans('custom.shipment_destination') }}</label>
                                <input type="text" class="form-control" wire:model.lazy="destination" placeholder="">
                                @error('destination')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.details') }}</label>
                                <textarea name="" id="" class="form-control " cols="30" rows="10"
                                    wire:model.lazy="details">
                                        </textarea>
                                @error('details')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                        </div>

                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="inquiries_and_quotes">
                            <h3>{{ trans('custom.your_info') }}</h3>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.your_name') }} *</label>
                                <input type="text" class="form-control" wire:model.lazy="name"> <!-- required -->
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.your_comapny') }}</label>
                                <input type="text" class="form-control" wire:model.lazy="companyname">
                                @error('companyname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.tel') }} </label>
                                <div class="row">
                                    <div class="col-3 form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                        <input type="tel" wire:model.lazy="code" class="form-control">
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-5 form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                        <input type="tel" wire:model.lazy="phone" class="form-control">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.email') }} </label>
                                <input type="email" class="form-control" wire:model.lazy="email"> <!-- required -->
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr>
                            <h3>{{ trans('custom.shipment_and_supplier_data') }}</h3>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.country') }}</label> <!-- كل الدول -->
                                <select class="form-control select2" id="exampleFormControlSelect1"
                                    wire:model.lazy="country">
                                    <option value="">--{{ trans('custom.select') }}--</option>
                                    @include('Admin.company.country')
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.supplier_name') }}</label>
                                <input type="text" class="form-control" wire:model.lazy="vendorname">
                                {{-- <select class="form-control"  wire:model.lazy="vendorId"wire:click.prevent="getVendor" >
                                            <option value="" >--select--</option>
                                            @forelse($vendors as $key => $vendor)
                                                <option value="{{ $vendor->id }}" > {{ $vendor->name }} </option>
                                            @empty
                                                <option value="">No vendor found</option>
                                            @endforelse
                                        </select> --}}
                                @error('vendorname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- {{ var_export($vendorId) }} --}}
                            {{-- <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                        <label>{{ trans('custom.supplier_address') }}</label>
                                        <input type="text" class="form-control">
                                    </div> --}}

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.supplier_phone') }}</label> <!-- تليفون عادي مش بالدول -->
                                <input type="number" class="form-control" wire:model.lazy="vendorphone">
                                @error('vendorphone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label>{{ trans('custom.supplier_email') }}</label>
                                <input type="email" class="form-control" wire:model.lazy="vendoremail">
                                @error('vendoremail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                                <label for="File">{{ trans('custom.upload_your_files') }} </label>
                                <input type="file" class="form-control-file" id="File" wire:model.lazy="file">
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="form-group ml-3 @if (app()->getLocale() == 'ar') form-group-ar @endif">
                            <button style="padding: 10px 34px;" type="submit"
                             {{-- wire:click="submit" --}}
                                class="btn buy  btn-3 hover-border-1 wobble-horizontal">{{ trans('custom.send') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

