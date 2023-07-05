@extends('Admin.layouts.master')
@section('title', __('plans.newplan'))
@section('css')
@endsection
@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            {{-- <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Checkout Form</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Page Layouts</a>
                            </li>
                            <li class="breadcrumb-item active">Checkout Form
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> --}}
            <div class="content-body">
                <!-- Bootstrap Checkout form -->
                <section id="social-cards">
                    <div class="row">
                        <div class="col-12 mt-3 mb-1">
                            <h4 class="text-uppercase">{{ __('plans.planshead') }} <span
                                    style="color:red;">{{ $plan->title }}</span> </h4>
                            {{-- <p>Below is an example form built entirely with Bootstrap's form controls. Each required form group has a
                            validation state that can be triggered by attempting to submit the form without completing it.</p> --}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 order-md-2 mb-4">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                {{-- <span class="text-muted">{{ __('plans.planrate') }}</span> --}}
                                {{-- <span class="badge badge-danger badge-pill">3</span> --}}
                            </h4>
                            <ul class="list-group mb-3 card">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ __('plans.planname') }}</h6>
                                        <small class="text-muted">{{ $plan->title }}</small>
                                    </div>
                                    <span class="text-muted">${{ $plan->price }}</span>
                                </li>
                                {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ trans('settings.rate') }}</h6>
                                    </div>
                                    <span class="text-muted">lt{{ $setting->rate }}</span>
                                </li> --}}
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ __('plans.rate') }} (ti)</span>
                                    <strong> {{ __('plans.lira') . ' ' . number_format($rateusd, 2) }}</strong>
                                    {{-- <strong class="badge badge-danger badge-pill">{{ __('plans.lira') . ' ' .number_format($rateusd,2) }}</strong> --}}
                                </li>
                            </ul>
                            @if (Auth::user()->plan->id != null)
                                <ul class="list-group mb-3 card">
                                    {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        @if (Auth::user()->status == 0)
                                            <div>
                                                <h6 class="my-0"> {{ __('plancheckout.status') }}
                                                    {{ __('plancheckout.unactive') }}</h6>
                                            </div>
                                        @else
                                            <div>
                                                <h6 class="my-0"> {{ __('plancheckout.status') }}
                                                    {{ __('plancheckout.subscribeactive') . ' ' . Auth::user()->plan->title }}
                                                </h6>
                                            </div>
                                        @endif
                                        <strong class="text-muted">{{ __('plans.lira') . ' ' . $oldprice  }}</strong>
                                    </li> --}}
                                    {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        @if (Auth::user()->status == 0)
                                            <div>
                                                <h6 class="my-0"> {{ __('plancheckout.status') }}
                                                    {{ __('plancheckout.unactive') }}</h6>
                                            </div>
                                        @else
                                            <div>
                                                <h6 class="my-0">
                                                    {{ __('plancheckout.neworder') . ' ' . $plan->title }}
                                                </h6>
                                            </div>
                                        @endif
                                        <strong class="text-muted">{{ __('plans.lira') . ' ' . $newprice??null  }}</strong>
                                    </li> --}}
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0"> {{ __('plancheckout.total') }}</h6>
                                        </div>
                                        <strong class="text-muted">{{ __('plans.lira') }} {{$total == null ? $rateusd : $total}}</strong>
                                    </li>
                                </ul>
                            @endif
                            {{-- بيانات الشركه --}}
                                <h3>{{ __('plancheckout.siteinfo') }}</h3>
                                <ul class="list-group mb-3 card">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h3 class="my-0">IBAN</h3>
                                        </div>
                                        <h3>{{ $ipan }}</h3>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        {{-- <div>
                                            <h6 class="my-0">{{ __('settings.company_name') }}</h6>
                                        </div> --}}
                                        <h3>{{ $setting->company_name }}</h3>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        {{-- <div>
                                            <h6 class="my-0">{{ __('settings.email') }}</h6>
                                        </div> --}}
                                        <h3>{{ $setting->email }}</h3>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        {{-- <div>
                                            <h6 class="my-0">{{ __('settings.company_phone') }}</h6>
                                        </div> --}}
                                        <h3>{{ $setting->phone }}</h3>
                                    </li>


                                </ul>
                            {{-- بيانات الشركه --}}

                            {{-- <form class="card p-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Promo code">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">Redeem</button>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                        <div class="col-md-8 order-md-1">
                            <h4 class="mb-3">{{ __('plans.companydata') }}</h4>

                            <form class="needs-validation p-2 bg-white card" novalidate=""
                                action="{{ route('admin.plans.checkoutorder') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="usdprice" value="{{ $plan->price }}">
                                    <input type="hidden" name="ltprice" value="{{ $rateusd }}">
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    @if (Auth::user()->plan->id == 1 || Auth::user()->plan->id == 2)
                                        <input type="hidden" name="oldusdprice" value="{{ Auth::user()->plan->price }}">
                                        <input type="hidden" name="oldltprice" value="{{  $oldprice }}">
                                    @else
                                        {{-- <input type="text" name="ltprice" value="{{ $rateusd }}"> --}}
                                    @endif
                                    <input type="hidden" name="ipan" value="{{ $ipan }}">
                                    <input type="hidden" name="planid" value="{{ $plan->id }}">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">{{ __('company.name') }}</label>
                                        <input type="text" class="form-control" value="{{ $company->name }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName">{{ __('company.phone') }}</label>
                                        <input type="text" class="form-control"
                                            value="{{ $company->code . ' ' . $company->phone }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">{{ __('company.email') }} </label>
                                        <input type="email" class="form-control" value="{{ $company->email }}" readonly>
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="address">{{ __('company.country') }}</label>
                                        <input type="text" class="form-control" value="{{ $company->country }}"
                                            readonly>
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="address">{{ __('plancheckout.idnum') }}</label>
                                        <input type="text" class="form-control" value="{{ old('idnum') }}"
                                            name="idnum">
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="address">{{ __('plans.image') }}</label>
                                        <input class="form-control img" name="image" type="file" required>
                                        {{-- <span class="form-text text-muted">{{ __('plans.ipansms') }}</span> --}}
                                    </div>
                                    {{-- <div class="col-md-4">
                                    <img src="{{ asset('images/no-image.png') }}" alt="" class="img-thumbnail img-preview" style="width:200px;">
                                </div> --}}
                                </div>
                                <hr class="mb-4">
                                  {{-- <h4 class="mb-1">Payment</h4>
                                    <div class="d-block my-2">
                                        <div class="custom-control custom-radio">
                                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                                            <label class="custom-control-label" for="credit">Credit card</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                                            <label class="custom-control-label" for="debit">Debit card</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                                            <label class="custom-control-label" for="paypal">Paypal</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-name">Name on card</label>
                                            <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                            <small class="text-muted">Full name as displayed on card</small>
                                            <div class="invalid-feedback">
                                                Name on card is required
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-number">Credit card number</label>
                                            <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                            <div class="invalid-feedback">
                                                Credit card number is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="cc-expiration">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                            <div class="invalid-feedback">
                                                Expiration date required
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="cc-expiration">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                            <div class="invalid-feedback">
                                                Security code required
                                            </div>
                                        </div>
                                    </div> --}}
                                <button class="btn btn-info btn-lg btn-block"
                                    type="submit">{{ __('plans.checkout') }}</button>
                            </form>
                            {{-- <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body">
                                                <p class="card-text">This example uploads a multiple files using dropzone js library. Using this method, user gets an option to select the files using a button instead dropping all the files after selected from the folders. You have to define <code>dropzone</code> and <code>previewsContainer</code> elements to show preview thumbnails. Also set <code>clickable</code> to match the button's id for button to work as file selector.</p>
                                                <button id="select-files" class="btn btn-primary mb-1"><i class="ft-file"></i> Click me to select files</button>
                                                <form action="#" class="dropzone dropzone-area" id="dpz-btn-select-files">
                                                    <div class="dz-message">Drop Files Here To Upload</div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </section>
                <!-- // Bootstrap Checkout form end -->

                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function() {
                        'use strict';

                        window.addEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');

                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                </script>

            </div>
        </div>
    </div>
@endsection
