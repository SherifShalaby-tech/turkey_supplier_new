@extends('Admin.layouts.master')
@section('title',trans('plancheckout.plancheckout'))
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
                                    <h4 class="card-title" id="basic-layout-form">{{trans('plancheckout.plancheckout')}}</h4>
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('plancheckout.company') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $plancheckout->company?->name }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('plancheckout.plan') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $plancheckout->plan?->title}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('plancheckout.status') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $plancheckout->status == 1 ? __('site.active') : __('site.unactive') }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('plancheckout.created_at') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $plancheckout->created_at->format('Y-m-d') }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('plancheckout.usdprice') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $plancheckout->usdprice }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('plancheckout.ltprice') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $plancheckout->ltprice }}" >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('plancheckout.image') }}</label>
                                                <div class="col-md-4">
                                                    @if($plancheckout->image)
                                                      {{-- <img src="{{ asset('Attachments/plan/'.$plancheckout->image) }}"
                                                      class=" " style="width:1000px;"> --}}
                                                      <embed src="{{url('/Attachments/plan/'.$plancheckout->image)}}" style="width:1000px; height:800px;" frameborder="0">
                                                    @else
                                                      <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="100px">
                                                    @endif
                                                </div>
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

