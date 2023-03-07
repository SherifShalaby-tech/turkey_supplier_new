@extends('Admin.layouts.master')
@section('title',__('contactSuppliers.show_contactSuppliers'))
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
                                <h4 class="card-title" id="basic-layout-form">{{trans('contactSuppliers.show_contactSupplier')}} {{ $contactSupplier->name }}</h4>
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
                                            <label for="projectinput1">{{ trans('contactSuppliers.contactSupplierName') }}</label>
                                            <input type="text" class="form-control" name="name" disabled
                                                value="{{ $contactSupplier->name }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput1">{{ trans('contactSuppliers.supplierName') }}</label>
                                            <input type="text" class="form-control" name="name" disabled
                                                value="{{ $contactSupplier->supplier->name ?? null }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput1">{{ trans('contactSuppliers.userName') }}</label>
                                            <input type="text" class="form-control" name="name" disabled
                                                value="{{ $contactSupplier->user->name ?? null }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">{{ trans('contactSuppliers.message') }}</label>
                                            <input type="text" class="form-control" name="name" disabled
                                                value="{!! $contactSupplier->message !!}" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">{{ trans('contactSuppliers.subject') }}</label>
                                            <input type="text" class="form-control" name="name" disabled
                                                value="{!! $contactSupplier->subject !!}" >
                                        {{-- {!! $contactSupplier->subject !!} --}}
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

