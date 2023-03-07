@extends('Admin.layouts.master')
@section('title', __('site.home'))
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @if (Auth::guard('company')->user() )
                    <section id="social-cards-glow">
                        <div class="row">
                            <div class="col-12 mt-3 mb-1">
                                <h4 class="text-uppercase">{{trans('plans.plans')}}</h4>
                                {{-- <p>For glow button add class in button <code>.btn-glow</code></p> --}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            @forelse(App\Models\Plan::get() as $plan)
                            {{-- <form action="{{ route('admin.plans.checkout',$plan) }}" method="get"> --}}
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="card profile-card-with-cover">
                                        <div class="card-content card-deck text-center">
                                            <div class="card box-shadow">
                                                <div class="card-header pb-0">
                                                    <h2 class="my-0 font-weight-bold danger">{{$plan->title}}</h2>
                                                </div>
                                                <div class="card-body">
                                                    <h1 class="pricing-card-title">{{$plan->price}}$ <small class="text-muted">/ mo</small></h1>
                                                    <ul class="list-unstyled mt-2 mb-2">
                                                        <li>  {{$plan->character_count ?? '-'}} {{trans('plans.character_count')}}</li>
                                                        <li>  {{$plan->company_picture_count ?? '-'}} {{trans('plans.company_picture_count')}}</li>
                                                        <li>  {{$plan->product_count ?? '-'}} {{trans('plans.product_count')}}</li>
                                                        <li>  {{$plan->product_picture_count ?? '-'}} {{trans('plans.product_picture_count')}}</li>
                                                        <li>  {{$plan->video_count ?? '-'}} {{trans('plans.video_count')}}</li>
                                                        <li>  {{$plan->speacial_customer ?? '-'}} {{trans('plans.speacial_customer')}}</li>
                                                    </ul>
                                                    @if (Auth::user()->plan->id == $plan->id && Auth::user()->status == true)
                                                    <a href="#" class="btn btn-lg btn-block btn-success btn-glow" >
                                                        {{ __('plancheckout.subscribeactive') . ' ' .$plan->title }}
                                                    </a>
                                                    @elseif (Auth::user()->plan->id > $plan->id && Auth::user()->status == true)
                                                        <a href="#" class="btn btn-lg btn-block btn-warning btn-glow" >
                                                            {{ __('plancheckout.subscribeactiveold') . ' ' .$plan->title }}
                                                        </a>
                                                    @else
                                                    <a href="{{ route('admin.plans.checkout',$plan) }}" class="btn btn-lg btn-block btn-danger btn-glow" >
                                                        {{ __('plancheckout.subscribe')  }}
                                                    </a>
                                                    @endif
                                                    {{-- <button type="button" class="btn btn-lg btn-block btn-danger btn-glow">اشترك الان</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- </form> --}}
                            @empty
                            @endforelse
                            {{-- <div class="col-xl-4 col-md-6 col-12">
                                <div class="card profile-card-with-cover">
                                    <div class="card-content card-deck text-center">
                                        <div class="card box-shadow">
                                            <div class="card-header pb-0">
                                                <h2 class="my-0 font-weight-bold danger">Pro</h2>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
                                                <ul class="list-unstyled mt-2 mb-2">
                                                    <li>20 users included</li>
                                                    <li>10 GB of storage</li>
                                                    <li>Email support</li>
                                                    <li>Help center access</li>
                                                </ul>
                                                <button type="button" class="btn btn-lg btn-block btn-danger btn-glow">Get started</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="card profile-card-with-cover">
                                    <div class="card-content card-deck text-center">
                                        <div class="card box-shadow">
                                            <div class="card-header pb-0">
                                                <h2 class="my-0 font-weight-bold danger">Enterprise</h2>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                                                <ul class="list-unstyled mt-2 mb-2">
                                                    <li>30 users included</li>
                                                    <li>15 GB of storage</li>
                                                    <li>Email support</li>
                                                    <li>Help center access</li>
                                                </ul>
                                                <button type="button" class="btn btn-lg btn-block btn-danger btn-glow">Contact us</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </section>
                @else

                @endif
                <!-- Revenue, Hit Rate & Deals -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_admins'))
                                            <a href="{{ route('admin.admins.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="info">{{ App\Models\Admin::count() }}</h3>
                                                    <h6>{{ __('admins.admins') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-users success font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_categories'))
                                            <a href="{{ route('admin.categories.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="warning">{{ App\Models\Category::count() }}</h3>
                                                    <h6>{{ __('categories.categories') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-notebook warning font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_sub_categories'))
                                            <a href="{{ route('admin.subcategories.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="success">{{ App\Models\SubCategories::count() }}</h3>
                                                    <h6>{{ __('sub_categories.sub_categories') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-notebook info font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_company'))
                                            <div class="col-md-6">
                                                <a href="{{ route('admin.companies.index') }}">
                                                    <div class="media-body text-left">
                                                        <h3 class="danger">
                                                            {{ App\Models\Company::where('trade_role', 'seller')->count() }}
                                                        </h3>
                                                        <h6>{{ __('company.seller') }}</h6>
                                                    </div>
                                                    <div>
                                                        <i class="icon-badge danger font-large-2 float-right"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ route('admin.companies.index') }}">
                                                    <div class="media-body text-left">
                                                        <h3 class="danger">
                                                            {{ App\Models\Company::where('trade_role', 'buyer')->count() }}
                                                        </h3>
                                                        <h6>{{ __('company.buyer') }}</h6>
                                                    </div>
                                                    {{-- <div>
                                                    <i class="icon-badge danger font-large-2 float-right"></i>
                                                </div> --}}
                                                </a>
                                            </div>
                                            {{-- <div class="col-md-3">
                                            <div>
                                                <i class="icon-badge danger font-large-2 float-right"></i>
                                            </div>
                                        </div> --}}
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_product'))
                                            <a href="{{ route('admin.products.index') }}">
                                                <div class="media-body text-left">

                                                    @if (auth('admin')->user())
                                                        <h3 class="info">{{ App\Models\Product::count() }}</h3>
                                                    @endif
                                                    @if (auth('company')->user() && auth('company')->user()->status == true)
                                                        <h3 class="info">
                                                            {{ App\Models\Product::where('company_id', Auth::guard('company')->user()->id)->count() }}
                                                        </h3>
                                                    @endif
                                                    @if (auth('clerk')->user())
                                                        <h3 class="info">
                                                            {{ App\Models\Product::where('company_id', Auth::guard('clerk')->user()->company->id)->count() }}
                                                        </h3>
                                                    @endif
                                                    <h6>{{ __('product.products') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-basket-loaded success font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_colors'))
                                            <a href="{{ route('admin.colors.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="success">{{ App\Models\Color::count() }}</h3>
                                                    <h6>{{ trans('colors.colors') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-camera info font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_sizes'))
                                            <a href="{{ route('admin.sizes.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="danger">{{ App\Models\Size::count() }}</h3>
                                                    <h6>{{ trans('sizes.sizes') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-check danger font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_service'))
                                            <a href="{{ route('admin.services.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="warning">{{ App\Models\Service::count() }}</h3>
                                                    <h6>{{ __('service.service') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_mediationorder'))
                                            <a href="{{ route('admin.MediationRequest.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="info">{{ App\Models\MediationOrder::count() }}</h3>
                                                    <h6>{{ trans('mediation_request.mediation_requests') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-rocket success font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_ads'))
                                            <a href="{{ route('admin.ads.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="warning">{{ App\Models\Ad::count() }}</h3>
                                                    <h6>{{ trans('ads.ads') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-paper-plane warning font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_plans'))
                                            <a href="{{ route('admin.plans.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="success">{{ App\Models\Plan::count() }}</h3>
                                                    <h6>{{ trans('plans.plans') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-book-open info font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_translationServices'))
                                            <a href="{{ route('admin.translationServices.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="danger">{{ App\Models\TranslationServices::count() }}</h3>
                                                    <h6>{{ trans('translationServices.translationServices') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-share danger font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        @if (auth()->user()->hasPermission('read_chats'))
                                            <a href="{{ route('admin.chats.index') }}">
                                                <div class="media-body text-left">
                                                    <h3 class="info">{{ App\Models\SupportChat::count() }}</h3>
                                                    <h6>{{ trans('chats.chats') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-speech success font-large-2 float-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
