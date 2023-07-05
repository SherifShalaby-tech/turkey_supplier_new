@extends('Admin.layouts.master')
@section('title',__('translationServices.newtranslationServices'))
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
                                <h4 class="card-title" id="basic-layout-form">{{ __('translationServices.newtranslationServices') }}</h4>
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
                                    <form  class="form" action="{{ route('admin.translationServices.store') }}" method="post" >
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('admins.name') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="name"
                                                        value="{{ old('name') }}" placeholder="{{ __('admins.name') }}">
                                                    </div>
                                                    @error('name')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('translationServices.companyname') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="companyname"
                                                        value="{{ old('companyname') }}" placeholder="{{ __('translationServices.companyname') }}">
                                                    </div>
                                                    @error('companyname')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ __('admins.phone') }}</label>
                                                        <input type="text" id="projectinput2"

                                                        class="form-control" name="phone" value="{{ old('phone') }}" placeholder="{{ __('admins.phone') }}" />
                                                    </div>
                                                    @error('phone')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ __('translationServices.country') }}</label>
                                                        <input type="text" id="projectinput2" class="form-control"  name="country"
                                                        value="{{ old('country') }}" placeholder="{{ __('translationServices.country') }}">
                                                    </div>
                                                    @error('country')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ __('translationServices.language') }}</label>
                                                        <select name="language" class="form-control">
                                                            <option value="" disabled readonly selected>{{ __('translationServices.chooselang') }}</option>
                                                            <option value="ar" {{ old('language') == 'ar' ? 'selected' : null }}>{{ __('translationServices.arabic') }}</option>
                                                            <option value="en" {{ old('language') == 'en' ? 'selected' : null }}>{{ __('translationServices.english') }}</option>
                                                            <option value="fr" {{ old('language') == 'fr' ? 'selected' : null }}>{{ __('translationServices.french') }}</option>
                                                            <option value="tr" {{ old('language') == 'tr' ? 'selected' : null }}>{{ __('translationServices.turkey') }}</option>
                                                        </select>
                                                    </div>
                                                    @error('language')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('translationServices.tocompanyname') }}</label>
                                                        <select name="company_id" class="form-control">
                                                            <option value="" selected disabled readonly>{{ __('translationServices.choose') }}</option>
                                                            @forelse(App\Models\Company::get() as $company)
                                                                <option value="{{ $company->id }}"
                                                                    {{ old('company_id')==$company->id?'selected':null }} >
                                                                    {{ $company->name }}
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        {{-- @error('company_id')<span class="text-danger">{{ $message }}</span>@enderror --}}
                                                    </div>
                                                    @error('company_id')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('translationServices.notes') }}</label>
                                                        <input type="text" class="form-control" name="notes"
                                                               value="{{ old('notes') }}"
                                                               placeholder="{{ trans('translationServices.notes') }}">
                                                    </div>
                                                    @error('notes')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#translation_textarea_table" aria-expanded="false"
                                                            aria-controls="collapseExample">
                                                        {{ __('translationServices.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_textarea', [
                                                        'attribute' => 'notes',
                                                        'translations' => [],
                                                    ])
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
@push('js')

@endpush

