@extends('Admin.layouts.master')
@section('title',trans('mediation_request.edit_mediation'))
@section('css')
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{trans('mediation_request.edit_mediation')}}</h4>
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
                                        <form action="{{route('admin.MediationRequest.update','test')}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$mediation->id}}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.client_name')}}</label>
                                                        <input value="{{$mediation->name}}" type="text" name="name" class="form-control">
                                                        @error('name')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.company_name')}}</label>
                                                        <select class="form-control" name="company_id">
                                                            <option value="">{{trans('custom.choose')}}</option>
                                                            @foreach($companies as $company)
                                                                <option {{$company->id == $mediation->company_id ? 'selected' : ''}} value="{{$company->id}}">{{$company->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('company_id')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-none">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.company_name')}}</label>
                                                        <input type="text" name="company_name" class="form-control">
                                                        @error('company_name')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.product_name')}}</label>
                                                        <select class="form-control" name="product_id">
                                                            <option value="">{{trans('custom.choose')}}</option>
                                                            @foreach($products as $product)
                                                                <option {{$product->id == $mediation->product_id ? 'selected' : ''}} value="{{$product->id}}">{{$product->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('product_id')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-none">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.product_name')}}</label>
                                                        <input type="text" name="product_name" class="form-control">
                                                        @error('product_name')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-none">
                                                    <div class="form-group">
                                                        <label>{{trans('custom.product_images')}}</label>
                                                        <input type="file" name="product_images[]" class="form-control">
                                                        @error('product_images')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-none">
                                                    <div class="form-group">
                                                        <label>{{trans('custom.product_desc')}}</label>
                                                        <textarea name="product_desc" class="form-control"></textarea>
                                                        @error('product_desc')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.phone')}}</label>
                                                        <input value="{{$mediation->phone}}" type="text" name="phone" class="form-control">
                                                        @error('phone')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.country')}}</label>
                                                        <input value="{{$mediation->country_address}}" type="text" name="country" class="form-control">
                                                        @error('country')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.qty')}}</label>
                                                        <input value="{{$mediation->qty}}" type="number" name="qty" class="form-control">
                                                        @error('qty')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('mediation_request.supply_period')}}</label>
                                                        <input value="{{$mediation->supply_period}}" type="text" name="supply_period" class="form-control">
                                                        @error('supply_period')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" value="{{trans('custom.save')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>



                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection
