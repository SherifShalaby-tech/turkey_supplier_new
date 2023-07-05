@extends('Admin.layouts.master')
@section('title',trans('product.show_product'))
@section('css')

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
                                    <h4 class="card-title" id="basic-layout-form">
                                        {{trans('shipment_order_news.showshipment_order_new')}} {{ $shipping->shipment_name }}
                                    </h4>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.shipping_way') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->shipment_name }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.receiving_from_the_supplier') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->shipment_type }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.input_unit') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->unit }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.length') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->length }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.width') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->width }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.height') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->height }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.dimensional_weight') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->dimensional_weight}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.weight_unit') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->weightunit}}" {{ $shipping->weight}} >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.package_weight') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->weight}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.number_of_packages') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->package_no}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.shipment_destination') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->destination}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.details') }}</label>
                                                <p>{!! $shipping->details!!}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">
                                        {{trans('shipment_order_news.client_data')}}
                                    </h4>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('shipment_order_news.client_name') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->name }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.your_comapny') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->companyname }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.tel') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->phone}}" >
                                                    {{-- value="{{ $shipping->code . ' '. $shipping->phone}}" > --}}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.email') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->email }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.country') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->country }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.supplier_name') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->vendorname }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.supplier_phone') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->vendorphone }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('custom.supplier_email') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $shipping->vendoremail }}" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">
                                        {{trans('shipment_order_news.attach')}}
                                    </h4>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {{-- <label for="projectinput1">{{ trans('shipment_order_news.client_name') }}</label> --}}
                                                @if ($shipping->file )
                                                <embed src="{{ Storage::url($shipping->file) }}" style="width:900px; height:800px;" frameborder="0">
                                                        {{-- @if( in_array($contactSupplier->file->extension(), ['png','jpg','jpeg','gif']) ) --}}
                                                        {{-- @if( $contactSupplier->file->contains(9)) --}}
                                                        {{-- <img src="{{ asset('storage/$shipping->file') }}" height="100" widtht="100" > --}}
                                                        {{-- <img src="<?php echo asset("storage/$shipping->file")?> " height="200" widtht="200"></img> --}}
                                                        {{-- @endif --}}
                                                        {{-- @if( in_array($contactSupplier->file->extension(), ['pdf']) ) --}}
                                                        {{-- <a class="btn btn-success" href="{{url('/Attachments/'.$contactSupplier->file)}}"> Download Attachment </a> --}}
                                                            {{-- <embed src="{{url('/public/'.$shipping->file)}}" type="application/pdf"
                                                                frameBorder="0"
                                                                scrolling="auto"
                                                                height="500" width="1000"> --}}
                                                        {{-- @endif --}}
                                                @endif
                                            </div>
                                        </div>

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

@endpush
