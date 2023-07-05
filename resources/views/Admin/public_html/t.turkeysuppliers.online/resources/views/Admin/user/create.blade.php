@extends('Admin.layouts.master')
@section('title','شركة جديدة')
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
                                <h4 class="card-title" id="basic-layout-form">شركة جديدة</h4>
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
                                    <form  class="form" action="{{ route('admin.companies.store') }}" method="post" >
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الإسم</label>
                                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                                                    </div>
                                                    @error('name')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">البريد الإلكترونى</label>
                                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                                    </div>
                                                    @error('email')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">رقم الجوال</label>
                                                        <input type="number" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="phone" />
                                                    </div>
                                                    @error('phone')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">الدولة</label>
                                                        <input type="text" class="form-control" name="country" value="{{ old('country') }}" placeholder="Country" />
                                                    </div>
                                                    @error('country')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
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
