@extends('Admin.layouts.master')
@section('title',trans('profile.profile'))
@section('css')

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('website/css/intlTelInput.min.css') }}">
{{-- <style>
    .kv-file-upload{
        display: none;
    }
</style> --}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ trans('profile.profile') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.home') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- account setting page start -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                            <li class="nav-item">
                                <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                    <i class="ft-globe mr-50"></i>
                                    {{ __('profile.data') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                    <i class="ft-lock mr-50"></i>
                                    {{ __('profile.editpass') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                    <i class="ft-info mr-50"></i>
                                    {{ __('profile.edit') }}
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link d-flex" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                    <i class="ft-camera mr-50"></i>
                                    Social links
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex" id="account-pill-connections" data-toggle="pill" href="#account-vertical-connections" aria-expanded="false">
                                    <i class="ft-feather mr-50"></i>
                                    Connections
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                    <i class="ft-message-square mr-50"></i>
                                    Notifications
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                            <div class="media">
                                                <a href="javascript: void(0);">
                                                    @if($company->firstMedia)
                                                    <img src="{{ asset('images/companies/' . $company->firstMedia->file_name) }}"
                                                         class="rounded mr-75" alt="{{ $company->name }}" height="64" width="64">
                                                    @endif
                                                </a>
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ __('profile.name') }}:</td>
                                                            <td class="users-view-username">{{ $company->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('profile.email') }}:</td>
                                                            <td class="users-view-name">{{ $company->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('profile.phones') }}:</td>
                                                            <td class="users-view-phone">({{ $company->cod }}) {{ $company->phone }}</td>
                                                            <td class="users-view-phone">{{ $company->phone1 }}</td>
                                                            <td class="users-view-phone">{{ $company->phone2 }}</td>
                                                            <td class="users-view-phone">{{ $company->phone3 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('profile.country') }}:</td>
                                                            <td>{{  $company->country }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('profile.plan') }}:</td>
                                                            <td>{{  $company->plan->title?? null }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('profile.desc') }}:</td>
                                                            <td>{!! $company->description !!}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <section id="image-gallery" class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">{{ __('company.images') }}</h4>
                                                    </div>
                                                    <div class="card-content collapse show">
                                                        <div class="card-body  my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                                                            <div class="row">
                                                                @forelse ( $company->media as $media)
                                                                    <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                        <a href="{{ asset('images/companies/' . $media->file_name) }}" itemprop="contentUrl" data-size="480x360">
                                                                            <img class="img-thumbnail img-fluid"
                                                                                 src="{{ asset('images/companies/' . $media->file_name) }}"
                                                                                 itemprop="thumbnail" alt="Image description" />
                                                                        </a>
                                                                    </figure>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="pswp__bg"></div>
                                                            <div class="pswp__scroll-wrap">
                                                                <div class="pswp__container">
                                                                    <div class="pswp__item"></div>
                                                                    <div class="pswp__item"></div>
                                                                    <div class="pswp__item"></div>
                                                                </div>
                                                                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                                                <div class="pswp__ui pswp__ui--hidden">

                                                                    <div class="pswp__top-bar">

                                                                        <!--  Controls are self-explanatory. Order can be changed. -->

                                                                        <div class="pswp__counter"></div>

                                                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                                                                        <button class="pswp__button pswp__button--share" title="Share"></button>

                                                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                                                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                                                                        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                                                                        <!-- element will get class pswp__preloader-active when preloader is running -->
                                                                        <div class="pswp__preloader">
                                                                            <div class="pswp__preloader__icn">
                                                                                <div class="pswp__preloader__cut">
                                                                                    <div class="pswp__preloader__donut"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                                                        <div class="pswp__share-tooltip"></div>
                                                                    </div>

                                                                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                                                                    </button>

                                                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                                                                    </button>

                                                                    <div class="pswp__caption">
                                                                        <div class="pswp__caption__center"></div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/ PhotoSwipe -->
                                                </section>
                                                <section id="image-gallery" class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">{{ __('company.products') }}</h4>
                                                    </div>
                                                    <div class="card-content collapse show">
                                                        <div class="card-body  my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                                                            <div class="row">
                                                                @forelse ( $company->products as $product)
                                                                    <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                        <a href="{{ asset('images/products/' . $product->firstMedia->file_name) }}" itemprop="contentUrl" data-size="480x360">
                                                                            <img class="img-thumbnail img-fluid"
                                                                                 src="{{ asset('images/products/' . $product->firstMedia->file_name) }}"
                                                                                 itemprop="thumbnail" alt="Image description" />
                                                                        </a>
                                                                    </figure>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="pswp__bg"></div>
                                                            <div class="pswp__scroll-wrap">
                                                                <div class="pswp__container">
                                                                    <div class="pswp__item"></div>
                                                                    <div class="pswp__item"></div>
                                                                    <div class="pswp__item"></div>
                                                                </div>
                                                                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                                                <div class="pswp__ui pswp__ui--hidden">

                                                                    <div class="pswp__top-bar">

                                                                        <!--  Controls are self-explanatory. Order can be changed. -->

                                                                        <div class="pswp__counter"></div>

                                                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                                                                        <button class="pswp__button pswp__button--share" title="Share"></button>

                                                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                                                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                                                                        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                                                                        <!-- element will get class pswp__preloader-active when preloader is running -->
                                                                        <div class="pswp__preloader">
                                                                            <div class="pswp__preloader__icn">
                                                                                <div class="pswp__preloader__cut">
                                                                                    <div class="pswp__preloader__donut"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                                                        <div class="pswp__share-tooltip"></div>
                                                                    </div>

                                                                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                                                                    </button>

                                                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                                                                    </button>

                                                                    <div class="pswp__caption">
                                                                        <div class="pswp__caption__center"></div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/ PhotoSwipe -->
                                                </section>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            <form novalidate method="post" action="{{ route('company.company.changePassword', $company->id) }}" >
                                                @csrf
                                                {{-- @method('PUT') --}}
                                                <input type="hidden" value="{{ $company->id }}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-new-password">{{ __('profile.password') }}</label>
                                                                <input type="password" name="password" id="account-new-password" class="form-control"
                                                                placeholder="{{ __('profile.password') }}" required data-validation-required-message="{{ __('profile.The_password_field_is_required') }}" minlength="6">
                                                            </div>
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-retype-new-password">{{ __('profile.retypepassword') }}</label>
                                                                <input type="password" name="password_confirmation" class="form-control"
                                                                required id="account-retype-new-password"
                                                                data-validation-match-match="password" placeholder="{{ __('profile.retypepassword') }}"
                                                                data-validation-required-message="{{ __('profile.The_Confirm_password_field_is_required') }}"
                                                                minlength="6">
                                                            </div>
                                                            @error('confirm_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">{{ __('profile.change') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                            <form novalidate method="post" action="{{ route('company.company.updatecompany') }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="{{ $company->id }}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('company.name') }}</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ $company->name }}"
                                                                placeholder="{{ __('company.name') }}">
                                                        </div>
                                                        @error('name')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                            </p>
                                                        @enderror
                                                        <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#translation_table_company" aria-expanded="false"
                                                            aria-controls="collapseExample">
                                                            {{ __('company.addtranslations') }}
                                                        </button>
                                                        @include('Admin.layouts.translation_inputs', [
                                                            'attribute' => 'name',
                                                            'translations' => [],
                                                            'type' => 'company',
                                                            'data' => $company,
                                                        ])
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="projectinput1">{{ __('company.desc') }}</label>
                                                                <textarea class="form-control tinymce" name="description">
                                                                    {!! $company->description !!}
                                                                </textarea>
                                                                @error('description')
                                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                                    </p>
                                                                @enderror
                                                                <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#translation_textarea_table" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                    {{ __('company.addtranslations') }}
                                                                </button>
                                                                @include('Admin.layouts.translation_textarea', [
                                                                    'attribute' => 'description',
                                                                    'translations' => [],
                                                                ])
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="accountSelect">{{ __('company.email') }}</label>
                                                            <input type="text" class="form-control" name="email"
                                                                value="{{ $company->email }}" placeholder="Email">
                                                        </div>
                                                        @error('email')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('company.plan') }}</label>
                                                            <select class="form-control select2" name="plan_id">
                                                                <option value="" disabled>{{ __('product.choose') }}</option>
                                                                    @foreach (App\Models\Plan::get() as $plan)
                                                                        <option value="{{ $plan->id }}"
                                                                            {{ old('plan_id',$company->plan_id) == $plan->id ?'selected':null }} >
                                                                            {{ $plan->title }}
                                                                        </option>
                                                                    @endforeach
                                                            </select>
                                                            @error('plan_id')
                                                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="projectinput2"> {{ __('company.phone') }}</label>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input type="tel" class="form-control" name="cod"
                                                                        value="{{ old('cod',$company->cod)}}"    />
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input type="tel" class="form-control" name="phone"
                                                                            value="{{ old('phone',$company->phone)}}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                                    </div>
                                                                    <span style="font-weight: bold;color: #0b1ce9;">{{ __('company.sms') }}</span>
                                                                </div>
                                                            </div>
                                                            @error('phone')
                                                                <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="projectinput2"> {{ __('company.phone1') }}</label>
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <input type="tel" class="form-control" name="phone1"
                                                                            value="{{ old('phone1',$company->phone1)}}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                                    </div>
                                                                    @error('phone1')
                                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="projectinput2"> {{ __('company.phone2') }}</label>
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <input type="tel" class="form-control" name="phone2"
                                                                            value="{{ old('phone2',$company->phone2)}}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                                    </div>
                                                                    @error('phone2')
                                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="projectinput2"> {{ __('company.phone3') }}</label>
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <input type="tel" class="form-control" name="phone3"
                                                                            value="{{ old('phone3',$company->phone3)}}"   onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                                    </div>
                                                                    @error('phone3')
                                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="country">{{ trans('custom.country_region') }}</label>
                                                            <select required="required" name="country"id="country"
                                                                class="country form-control select2 @error('country') is-invalid @enderror">
                                                                <option value="" >---choose---</option>
                                                                @include('Admin.company.country2')
                                                            </select>
                                                            @error('country')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ trans('company.image') }}</label>
                                                            <div class="file-loading">
                                                                <input type="file" id="company-images" class="form-control file-input-overview" name="images[]" multiple />
                                                            </div>
                                                        </div>
                                                        @error('image')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">{{ __('profile.change') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- <div class="tab-pane fade " id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                            <form>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="account-twitter">Twitter</label>
                                                            <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="account-facebook">Facebook</label>
                                                            <input type="text" id="account-facebook" class="form-control" placeholder="Add link">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="account-google">Google+</label>
                                                            <input type="text" id="account-google" class="form-control" placeholder="Add link">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="account-linkedin">LinkedIn</label>
                                                            <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="account-instagram">Instagram</label>
                                                            <input type="text" id="account-instagram" class="form-control" placeholder="Add link">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="account-quora">Quora</label>
                                                            <input type="text" id="account-quora" class="form-control" placeholder="Add link">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                            changes</button>
                                                        <button type="reset" class="btn btn-light">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="account-vertical-connections" role="tabpanel" aria-labelledby="account-pill-connections" aria-expanded="false">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <a href="javascript: void(0);" class="btn btn-info">Connect to
                                                        <strong>Twitter</strong></a>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                    <h6>You are connected to facebook.</h6>
                                                    <span>Johndoe@gmail.com</span>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <a href="javascript: void(0);" class="btn btn-danger">Connect to
                                                        <strong>Google</strong>
                                                    </a>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                    <h6>You are connected to Instagram.</h6>
                                                    <span>Johndoe@gmail.com</span>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-light">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                            <div class="row">
                                                <h6 class="ml-1 mb-2">Activity</h6>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch1">
                                                        <label class="ml-50" for="accountSwitch1">Email me when someone comments
                                                            onmy
                                                            article</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch2">
                                                        <label for="accountSwitch2" class="ml-50">Email me when someone answers on
                                                            my
                                                            form</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="checkbox" class="switchery" data-size="sm" id="accountSwitch3">
                                                        <label for="accountSwitch3" class="ml-50">Email me hen someone follows
                                                            me</label>
                                                    </div>
                                                </div>
                                                <h6 class="ml-1 my-2">Application</h6>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch4">
                                                        <label for="accountSwitch4" class="ml-50">News and announcements</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="checkbox" class="switchery" data-size="sm" id="accountSwitch5">
                                                        <label for="accountSwitch5" class="ml-50">Weekly product updates</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch6">
                                                        <label for="accountSwitch6" class="ml-50">Weekly blog digest</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-light">Cancel</button>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- account setting page end -->
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script> --}}
    <script>
         $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        $(function(){
            $("#company-images").fileinput({
                    // theme: "bs5",
                    uploadUrl: "{{ route('admin.companies.upload_image')}}",
                    uploadAsync: true,
                    minFileCount: 1,
                    maxFileCount: 50,
                    overwriteInitial: true,
                    data: {'_token': "{{csrf_token()}}"},
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: true,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: [
                        @if($company->media()->count() > 0)
                            @foreach($company->media as $media)
                                "{{ asset('images/companies/' . $media->file_name) }}",
                            @endforeach
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if($company->media()->count() > 0)
                            @foreach($company->media as $media)
                                {
                                    caption: "{{ $media->file_name }}",
                                    size: '{{ $media->file_size }}',
                                    width: "120px",
                                    url: "{{ route('admin.companies.remove_image', ['image_id' => $media->id, 'company_id' => $company->id, '_token' => csrf_token()]) }}",
                                    key: {{ $media->id }}
                                },
                            @endforeach
                        @endif
                    ]
                }).on('filesorted', function (event, params) {
                    console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
                });
        });
    </script>
@endpush

