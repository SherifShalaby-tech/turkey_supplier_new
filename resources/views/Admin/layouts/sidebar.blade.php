<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if (auth()->user()->hasPermission('read_home'))
                <li>
                    <a class="menu-item" href="{{ route('admin.home') }}">
                        <i class="la la-home"></i>
                        <span data-i18n="Classic Menu">{{ __('admin.home') }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_settings'))
                <li>
                    <a class="menu-item" href="{{ route('admin.settings.edit') }}">
                        <i class="icon-note"></i>
                        <span data-i18n="Classic Menu"> {{trans('settings.settings')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_admins'))
                <li>
                    <a class="menu-item" href="{{ route('admin.admins.index') }}">
                        <i class="icon-users"></i>
                        <span data-i18n="Classic Menu">{{ __('admins.admins') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Admin::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_categories'))
                <li>
                    <a class="menu-item" href="{{ route('admin.categories.index') }}">
                        <i class="icon-notebook"></i>
                        <span data-i18n="Classic Menu"> {{__('categories.categories') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Category::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_sub_categories'))
                <li>
                    <a class="menu-item" href="{{ route('admin.subcategories.index') }}">
                        <i class="icon-notebook"></i>
                        <span data-i18n="Classic Menu"> {{ __('sub_categories.sub_categories') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\SubCategories::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_company'))
                <li>
                    <a class="menu-item" href="{{ route('admin.companies.index') }}">
                        <i class="icon-badge"></i>
                        <span data-i18n="Classic Menu">{{ __('company.seller') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Company::where('trade_role','seller')->count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_company'))
                <li>
                    <a class="menu-item" href="{{ route('admin.clients.index') }}">
                        <i class="icon-badge"></i>
                        <span data-i18n="Classic Menu">{{ __('company.buyer') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Company::where('trade_role','buyer')->count() }}</span>
                    </a>
                </li>
            @endif
           @if (auth()->user()->hasPermission('read_clerks'))
               <li>
                   <a class="menu-item" href=" @if(auth('company')->user() && (auth('company')->user()->plan->id <= 0 || auth('company')->user()->status != true)) # @else {{ route('admin.clerks.index') }} @endif">
                       <i class="icon-badge"></i>
                       <span data-i18n="Classic Menu">{{ __('clerks.clerks') }}</span>
                       @if(Auth::guard('admin')->user())
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Clerk::count() }}</span>
                       @elseif(Auth::guard('company')->user())
                        <span class="badge badge badge-info badge-pill float-right mr-2">
                            {{ App\Models\Clerk::where('company_id', Auth::guard('company')->user()->id)->count() }}
                        </span>
                       @endif
                   </a>
               </li>
           @endif
            @if (auth()->user()->hasPermission('read_product'))
                <li>
                    <a class="menu-item" href=" @if(auth('company')->user() && (auth('company')->user()->plan->id <= 0 || auth('company')->user()->status != true)) # @else {{ route('admin.products.index') }} @endif">
                        <i class="icon-basket-loaded"></i>
                        <span data-i18n="Classic Menu"> {{ __('product.products') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">
                            @if(auth('admin')->user())
                                {{ App\Models\Product::count() }}
                            @endif
                            @if(auth('company')->user() )
                                {{ App\Models\Product::where('company_id',Auth::guard('company')->user()->id)->count() }}
                            @endif
                            @if(auth('clerk')->user())
                             {{ App\Models\Product::where('company_id',Auth::guard('clerk')->user()->company->id)->count() }}
                            @endif
                        </span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_colors'))
                <li>
                    <a class="menu-item" href="{{ route('admin.colors.index') }}">
                        <i class="icon-camera"></i>
                        <span data-i18n="Classic Menu"> {{ __('colors.colors') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Color::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_sizes'))
                <li>
                    <a class="menu-item" href="{{ route('admin.sizes.index') }}">
                        <i class="icon-check"></i>
                        <span data-i18n="Classic Menu"> {{ __('sizes.sizes') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Size::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_leadtimes'))
                <li>
                    <a class="menu-item" href="{{ route('admin.leadtimes.index') }}">
                        <i class="icon-clock"></i>
                        <span data-i18n="Classic Menu"> {{ __('leadtimes.leadtimes') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Leadtime::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_service'))
                <li>
                    <a class="menu-item" href="{{ route('admin.services.index') }}">
                        <i class="icon-pie-chart"></i>
                        <span data-i18n="Classic Menu"> {{ __('service.service') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Service::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_plans'))
                <li>
                    <a class="menu-item" href="{{ route('admin.plans.index') }}">
                        <i class="icon-book-open"></i>
                        <span data-i18n="Classic Menu"> {{trans('plans.plans')}}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Plan::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_translationServices'))
                <li>
                    <a class="menu-item" href="{{ route('admin.translationServices.index') }}">
                        <i class="icon-share"></i>
                        <span data-i18n="Classic Menu"> {{trans('translationServices.translationServices')}}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\TranslationServices::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_mediations'))
                <li>
                    <a class="menu-item" href="{{route('admin.mediations.index')}}">
                        <i class="icon-rocket"></i>
                        <span data-i18n="Classic Menu"> {{trans('mediations.mediation')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_translations'))
                <li>
                    <a class="menu-item" href="{{route('admin.translations.index')}}">
                        <i class="icon-rocket"></i>
                        <span data-i18n="Classic Menu"> {{trans('translations.translations')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_mediationorder'))
                <li>
                    <a class="menu-item" href="{{route('admin.MediationRequest.index')}}">
                        <i class="icon-rocket"></i>
                        <span data-i18n="Classic Menu"> {{trans('mediation_request.mediation_requests')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_about_us'))
                <li>
                    <a class="menu-item" href="{{ route('admin.aboutnews.index') }}">
                        <i class="icon-question"></i>
                        <span data-i18n="Classic Menu"> {{trans('aboutnew.aboutnew')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_tradeshows'))
                <li>
                    <a class="menu-item" href="{{route('admin.tradeShows.index')}}">
                        <i class="icon-equalizer"></i>
                        <span data-i18n="Classic Menu"> {{trans('tradeshows.tradeshows')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_ads'))
                <li>
                    <a class="menu-item" href="{{ route('admin.ads.index') }}">
                        <i class="icon-paper-plane"></i>
                        <span data-i18n="Classic Menu"> {{trans('ads.ads')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_helpcenters'))
                <li>
                    <a class="menu-item" href="{{ route('admin.helpcenters.index') }}">
                        <i class="icon-pin"></i>
                        <span data-i18n="Classic Menu"> {{trans('helpcenters.helpcenters')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_polices'))
                <li>
                    <a class="menu-item" href="{{ route('admin.polices.index') }}">
                        <i class="icon-call-in"></i>
                        <span data-i18n="Classic Menu" style="font-size: 12px;"> {{trans('polices.polices')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_contactus'))
                <li>
                    <a class="menu-item" href="{{ route('admin.contact-us') }}">
                        <i class="icon-envelope-letter"></i>
                        <span data-i18n="Classic Menu" >{{trans('contactus.contactus')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_chats'))
                <li>
                    <a class="menu-item" href="{{ route('admin.chats.index') }}">
                        <i class="icon-speech"></i>
                        <span data-i18n="Classic Menu" >{{__('chats.chats')}}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\SupportChat::count() }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_reports'))
                <li class=" nav-item"><a href="#"><i class="la la-calendar"></i><span class="menu-title" data-i18n="Calendars">{{trans('reports.reports')}}</span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('admin.reports') }}"><i></i>
                                <span data-i18n="CLNDR">{{trans('reports.sellereports')}}</span></a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.buyerreports') }}"><i></i>
                                <span data-i18n="CLNDR">{{trans('reports.buyereports')}}</span></a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.visitoreports') }}"><i></i>
                                <span data-i18n="CLNDR">{{trans('reports.visitoreports')}}</span></a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_orders'))
                <li>
                    <a class="menu-item" href="{{ route('admin.orders.index') }}">
                        <i class="icon-handbag"></i>
                        <span data-i18n="Classic Menu" > {{trans('orders.orders')}}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Sale::count() }}</span>
                    </a>
                </li>
            @endif
            @if(auth()->user()->hasPermission('read_contactsuppliers'))
                <li> 
                    <a class="menu-item" href=" @if(auth('company')->user() && (auth('company')->user()->plan->id <= 0 || auth('company')->user()->status != true)) # @else {{ route('admin.contactSuppliers.index') }} @endif">
                        <i class="la la-envelope"></i>
                        <span data-i18n="Classic Menu" > {{trans('contactsuppliers.contactsuppliers')}}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">
                            @if(Auth::guard('company')->user())
                                {{ App\Models\ContactSupplier::where('supplier_id', Auth::guard('company')->user()->id)->count() }}
                            @endif
                            @if(auth('clerk')->user())
                                {{ App\Models\ContactSupplier::where('supplier_id', Auth::guard('clerk')->user()->company_id)->count() }}
                            @endif
                        </span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_newcat'))
                <li class=" nav-item"><a href="#"><i class="la la-plus"></i><span class="menu-title" data-i18n="Calendars">{{trans('newcat.newcatrequest')}}</span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('admin.newcat.index') }}"><i></i>
                                <span data-i18n="CLNDR">{{trans('newcat.newcat')}}</span>
                                <span class="badge badge badge-info badge-pill float-right mr-2">
                                    {{ App\Models\NewCategory::count() }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.newsubcat.index') }}"><i></i>
                                <span data-i18n="CLNDR">{{trans('newcat.newsubcat')}}</span>
                                <span class="badge badge badge-info badge-pill float-right mr-2">
                                    {{ App\Models\NewSubCategory::count() }}
                                </span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif
            @if (auth()->user()->hasPermission('read_shipment_order_news'))
                <li>
                    <a class="menu-item" href="{{ route('admin.shippings.index') }}">
                        <i class="la ft-message-circle"></i>
                        <span data-i18n="Classic Menu">{{ __('custom.shipping') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">
                            {{ App\Models\ShipmentOrderNew::count() }}
                        </span>
                    </a>
                </li>
            @endif

            @if(Auth::guard('admin')->user())
                <li>
                    <a class="menu-item" href="{{ route('subscribe') }}">
                        <i class="la ft-message-circle"></i>
                        <span data-i18n="Classic Menu">{{ __('custom.email_subscribtion') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">
                            {{ App\Models\SubScribe::count() }}
                        </span>
                    </a>
                </li>
             @endif
            {{-- @if (auth()->user()->hasPermission('read_shipment_order_news')) --}}
            @if(Auth::guard('admin')->user())
                <li>
                    <a class="menu-item" href="{{ route('admin.plancheckouts.index') }}">
                        <i class="la ft-message-circle"></i>
                        <span data-i18n="Classic Menu">{{ __('plancheckout.plancheckout') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">
                            {{ App\Models\Plancheckout::whereStatus(0)->count() }}
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
