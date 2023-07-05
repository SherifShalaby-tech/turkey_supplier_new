@extends('Admin.layouts.master')
@section('title',trans('about_us.about_us'))
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
                                    <h4 class="card-title" id="basic-layout-form">{{trans('about_us.about_us')}}</h4>
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
                                        <form  class="form" action="{{ route('admin.post_about_us',$about_us->id) }}" enctype="multipart/form-data" method="post" >
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('about_us.about_us')}}</label>
                                                            <textarea class="form-control" name="about_us" placeholder="{{trans('about_us.about_us')}}">{{ $about_us->about_us }}</textarea>
                                                        </div>
                                                        @error('about_us')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#translation_textarea_table" aria-expanded="false"
                                                                aria-controls="collapseExample">
                                                            {{ __('company.addtranslations') }}
                                                        </button>
                                                        @include('Admin.layouts.translation_textarea', [
                                                            'attribute' => 'about_us',
                                                            'translations' => [],
                                                            'data' => $about_us,
                                                        ])
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('about_us.services')}}</label>
                                                            <textarea class="form-control" name="services" placeholder="{{trans('about_us.services')}}">{{ $about_us->services }}</textarea>
                                                        </div>
                                                        @error('services')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#translation_textarea_table" aria-expanded="false"
                                                                aria-controls="collapseExample">
                                                            {{ __('company.addtranslations') }}
                                                        </button>
                                                        @include('Admin.layouts.translation_textarea', [
                                                            'attribute' => 'services',
                                                            'translations' => [],
                                                            'data' => $about_us,
                                                        ])
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('about_us.shipping_products')}}</label>
                                                            <textarea class="form-control" name="shipping_products" placeholder="{{trans('about_us.shipping_products')}}">{{ $about_us->shipping_products }}</textarea>
                                                        </div>
                                                        @error('shipping_products')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#translation_textarea_table" aria-expanded="false"
                                                                aria-controls="collapseExample">
                                                            {{ __('company.addtranslations') }}
                                                        </button>
                                                        @include('Admin.layouts.translation_textarea', [
                                                            'attribute' => 'shipping_products',
                                                            'translations' => [],
                                                            'data' => $about_us,
                                                        ])
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('about_us.mediation')}}</label>
                                                            <textarea class="form-control" name="mediation" placeholder="{{trans('about_us.mediation')}}">{{ $about_us->mediation }}</textarea>
                                                        </div>
                                                        @error('mediation')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#translation_textarea_table" aria-expanded="false"
                                                                aria-controls="collapseExample">
                                                            {{ __('company.addtranslations') }}
                                                        </button>
                                                        @include('Admin.layouts.translation_textarea', [
                                                            'attribute' => 'mediation',
                                                            'translations' => [],
                                                            'data' => $about_us,
                                                        ])
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('about_us.images')}}</label>
                                                            <input type="file" name="images[]" class="form-control" multiple>
                                                        </div>
                                                        @error('images')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{trans('site.save')}}
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

@stop
