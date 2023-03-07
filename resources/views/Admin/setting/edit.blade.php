@extends('Admin.layouts.master')
@section('title',__('settings.settings'))
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
                                <h4 class="card-title" id="basic-layout-form">{{trans('settings.settings')}}</h4>
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
                                    <form  class="form" action="{{ route('admin.settings.update',$setting->id) }}" enctype="multipart/form-data" method="post" >
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.company_name')}}</label>
                                                        <input type="text" class="form-control" name="company_name" value="{{ $setting->company_name }}" placeholder="{{trans('settings.company_name')}}">
                                                    </div>
                                                    @error('company_name')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.company_phone')}}</label>
                                                        <input type="text" class="form-control" name="company_phone" value="{{ $setting->company_phone }}" placeholder="{{trans('settings.company_phone')}}">
                                                    </div>
                                                    @error('company_phone')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.company_address')}}</label>
                                                        <input type="text" class="form-control" name="company_address" value="{{ $setting->company_address }}" placeholder="{{trans('settings.company_address')}}">
                                                    </div>
                                                    @error('company_address')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.email')}}</label>
                                                        <input type="text" class="form-control" name="email" value="{{ $setting->email }}" placeholder="{{trans('settings.email')}}">
                                                    </div>
                                                    @error('email')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.city')}}</label>
                                                        <input type="text" class="form-control" name="city" value="{{ $setting->city }}" placeholder="{{trans('settings.city')}}">
                                                    </div>
                                                    @error('city')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.facebook')}}</label>
                                                        <input type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}" placeholder="{{trans('settings.facebook')}}">
                                                    </div>
                                                    @error('facebook')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.linkedin')}}</label>
                                                        <input type="text" class="form-control" name="linkedin" value="{{ $setting->linkedin }}" placeholder="{{trans('settings.google')}}">
                                                    </div>
                                                    @error('linkedin')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">

                                                        <label for="projectinput1">{{trans('settings.instagram')}}</label>
                                                        <input type="text" class="form-control" name="instagram" value="{{ $setting->instagram }}" placeholder="{{trans('settings.instagram')}}">
                                                    </div>
                                                    @error('instagram')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.youtube')}}</label>
                                                        <input type="text" class="form-control" name="youtube" value="{{ $setting->youtube }}" placeholder="{{trans('settings.youtube')}}">
                                                    </div>
                                                    @error('youtube')
<<<<<<< HEAD
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.whatsapp')}}</label>
                                                        <input type="text" class="form-control" name="whatsapp" value="{{ $setting->whatsapp }}" placeholder="{{trans('settings.whatsapp')}}">
                                                    </div>
                                                    @error('whatsapp')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.rate')}}</label>
                                                        <input type="text" class="form-control" name="rate" value="{{ $setting->rate }}" placeholder="{{trans('settings.rate')}}">
                                                    </div>
                                                    @error('rate')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.ipan')}}</label>
                                                        <input type="text" class="form-control" name="ipan" value="{{ $setting->ipan }}" placeholder="{{trans('settings.ipan')}}">
                                                    </div>
                                                    @error('ipan')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.phone')}}</label>
                                                        <input type="text" class="form-control" name="phone" value="{{ $setting->phone }}" placeholder="{{trans('settings.phone')}}">
                                                    </div>
                                                    @error('phone')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.logo')}}</label>
                                                        <input type="file" class="form-control img" name="logo" accept="image/*">
                                                    </div>
                                                    @error('logo')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 " style="display: flex;align-items: center;justify-content: flex-start;">
                                                    @if($setting->logo)
                                                      <img src="{{ asset('images/logo/'.$setting->logo) }}"
                                                      alt="" class=" img-preview" style="width: 200px;height:150px;border-radius: 4px">
                                                    @else
                                                      <img src="{{ asset('images/logo.png') }}" alt="" class="img-thumbnail img-preview" style="width: 100px;">
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.metadesc')}}</label>

                                                        <textarea name="metadesc" id=""  class="form-control summernote">

                                                              {!! $setting->metadesc !!}
                                                        </textarea>
                                                    </div>
                                                    @error('metadesc')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('settings.metakeyword')}}</label>

                                                        <textarea name="metakeyword" id=""  class="form-control summernote">

                                                              {!! $setting->metakeyword !!}
                                                        </textarea>
                                                    </div>
                                                    @error('metakeyword')
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
@endsection
@push('js')
<script>

</script>
@endpush

