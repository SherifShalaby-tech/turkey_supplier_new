@extends('Admin.layouts.master')
@section('title',__('plans.editplan'))
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
                                <h4 class="card-title" id="basic-layout-form">{{trans('plans.editplan')}}</h4>
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
                                    <form enctype="multipart/form-data" class="form" action="{{ route('admin.plans.update',$plan->id) }}" method="post" >
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.title')}}</label>
                                                        <input type="text" class="form-control" name="title" value="{{ $plan->title }}" placeholder="{{trans('plan.title')}}">
                                                    </div>
                                                    @error('title')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.character_count')}}</label>
                                                        <input type="text" class="form-control" name="character_count" value="{{ $plan->character_count }}" placeholder="{{trans('plan.character_count')}}">
                                                    </div>
                                                    @error('character_count')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.speacial_customer')}}</label>
                                                        <input type="number" class="form-control" name="speacial_customer" value="{{ old('speacial_customer',$plan->speacial_customer) }}"
                                                         value="{{ $plan->speacial_customer }}">
                                                    </div>
                                                    @error('speacial_customer')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.company_picture_count')}}</label>
                                                        <input type="text" class="form-control" name="company_picture_count" value="{{ $plan->company_picture_count }}" placeholder="{{trans('plan.company_picture_count')}}">
                                                    </div>
                                                    @error('company_picture_count')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.product_count')}}</label>
                                                        <input type="text" class="form-control" name="product_count" value="{{ $plan->product_count }}" placeholder="{{trans('plan.product_count')}}">
                                                    </div>
                                                    @error('product_count')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.product_picture_count')}}</label>
                                                        <input type="text" class="form-control" name="product_picture_count" value="{{ $plan->product_picture_count }}" placeholder="{{trans('plan.product_picture_count')}}">
                                                    </div>
                                                    @error('product_picture_count')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.video_time')}}</label>
                                                        <input type="text" class="form-control" name="video_time" value="{{ $plan->video_time }}" placeholder="{{trans('plan.video_time')}}">
                                                    </div>
                                                    @error('video_time')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.video_count')}}</label>
                                                        <input type="text" class="form-control" name="video_count" value="{{ $plan->video_count }}" placeholder="{{trans('plan.video_count')}}">
                                                    </div>
                                                    @error('video_count')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('plans.price')}}</label>
                                                        <input type="text" class="form-control" name="price" value="{{ $plan->price }}" placeholder="{{trans('plan.price')}}">
                                                    </div>
                                                    @error('price')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ trans('product.image') }}</label>
                                                        <input type="file" id="projectinput2"  class="form-control" name="image"
                                                               multiple />
                                                    </div>
                                                    @error('image')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                    </p>
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
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
