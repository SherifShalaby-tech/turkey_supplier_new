<style>
    @media(max-width: 767px){
        .navbar-light .img-soc{
            width: 25px !important;
        }
    }

    .dropdown-menu .dropdown-toggle:after{
        border-top: .3em solid transparent;
        border-right: 0;
        border-bottom: .3em solid transparent;
        border-left: .3em solid;
    }

    .dropdown-menu .dropdown-menu{
        margin-left:0; margin-right: 0;
    }

    .dropdown-menu li{
        position: relative;
    }
    .nav-item .submenu{
        display: none;
        position: absolute;
        left:100%; top:-7px;
    }
    .nav-item .submenu-left{
        right:100%; left:auto;
    }

    .dropdown-menu > li:hover{ background-color: #f1f1f1 }
    .dropdown-menu > li:hover > .submenu{
        display: block;
    }

.navbar{
    box-shadow: rgb(100 100 111 / 20%) 0px 12px 29px 0px;
}
.p-5 {
    padding: 0 5rem!important;
}
@media (max-width: 1024px) {
         .p-5 {
            padding: 0 !important;
        }

    }
@media (max-width: 425px) {
         .p-5 {
            padding: 0 !important;
        }
        .display-n-d{
            display: block !important;
        }
    }

@media (max-width: 375px) {
         .p-5 {
            padding: 0 !important;
        }
        .display-n-d{
            display: block !important;
        }
    }

@media (max-width: 320px) {
         .p-5 {
            padding: 0 !important;
        }
        .display-n-d{
            display: block !important;
        }

    }

    .dropdown-menu {
        min-width:fit-content !important;
    }
    .dropdown-menu .dropdown-item {
        font-size: 20px !important;
    }
    .dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.200em;
        vertical-align: 0.255em;
        content: "";
        top: 0;
        position: absolute;
        border-top: 0.3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }
    .display-n-d{
            display: none;
        }
</style>
{{-- <script type="text/javascript">

    $(document).ready(function() {

        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(function(e){
                e.preventDefault();
                if($(this).next('.submenu').length){
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function () {
                    $(this).find('.submenu').hide();
                })
            });
        }

    });
</script> --}}
<!-- navbar -->
<nav class=" navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;padding: 0; font-family:CustomFont; letter-spacing: 1.2px;font-weight: 100 !important;" >
    <div class="container-fluid container-nav">
{{--        <a class="navbar-brand" href="#">Categories</a>--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav " style="align-items: center; @if(app()->getLocale() == 'ar') padding-right: 0 !important; align-items: center; @endif ">
                {{-- <i class="fa fa-list-ul" style="margin-top: 12px"></i> --}}
                @php
                    if(app()->getLocale() == 'ar'){
                $cats = App\Models\Category::orderBy('namear')->get(['id', 'name', 'translation']);
                }elseif(app()->getLocale() == 'en'){
                    $cats = App\Models\Category::orderBy('nameen')->get(['id', 'name', 'translation']);
                }elseif(app()->getLocale() == 'tr'){
                    $cats = App\Models\Category::orderBy('nametr')->get(['id', 'name', 'translation']);
                }else{
                    $cats = App\Models\Category::orderBy('name')->get(['id', 'name', 'translation']);
                }
                @endphp
                <li class="nav-item dropdown display-n-m"  style=" z-index: 1000 ; padding-right: 20px;">

                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{trans('custom.categories')}}</a>
                    <ul class="dropdown-menu" style="@if(app()->getLocale() == 'ar') right: 0px; width: fit-content; @endif  " >
                        @if($cats->count() > 0)
                            @foreach($cats as $category)
                                <li>
                                    <a class="dropdown-item" href="{{route('category.products',$category->id)}}"> {{$category->name}} </a>
                                    <ul class="submenu dropdown-menu" style="@if(app()->getLocale() == 'ar') right: 100%;left: 0; width: fit-content; @endif ">
                                        @if($category->subCategories->count() > 0)
                                            @foreach($category->subCategories as $sub)
                                                <li><a class="dropdown-item" href="{{route('subcategory.products',$sub->id)}}">{{$sub->name}}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                    <li class="nav-item wobble-bottom">
                        <a class="nav-link" href="{{route('mediation')}}">{{trans('custom.mediation')}}</a>
                    </li>
                    <li class="nav-item wobble-bottom">
                        <a class="nav-link" href="{{route('translationServices')}}">{{trans('custom.translation_services')}}</a>
                    </li>
                    <li class="nav-item wobble-bottom">
                        <a class="nav-link" href="{{route('tradeShow')}}">{{trans('tradeshows.tradeshows')}}</a>
                    </li>
                    <li class="nav-item wobble-bottom">
                        <a class="nav-link" href="{{route('shipping')}}">{{trans('custom.shipping')}}</a>
                    </li>
                    <li class="nav-item wobble-bottom">
                        <a class="nav-link" href="{{route('membership')}}">{{trans('site.sub')}}</a>
                    </li>
                    @check_guard
                        <li class="nav-item wobble-bottom">
                            <a class="nav-link" href="{{route('webLogin')}}">{{trans('custom.login')}}</a>
                        </li>
                        <li class="nav-item wobble-bottom">
                            <a class="nav-link" href="{{route('webRegister')}}">{{trans('custom.register')}}</a>
                        </li>
                    @endcheck_guard
                    <li class="nav-item wobble-bottom">
                        <a class="nav-link" href="{{route('about_us')}}">{{trans('custom.about_us')}}</a>
                    </li>
            </ul>


        @php
            $setting = \App\Models\Setting::first();
        @endphp
            <div class=" test-lang @if (app()->getLocale() == 'ar') test-lang-ar @endif " style="display: flex;
                justify-content: center;
                align-items: center;
                background-color: #fff;
                padding: 4px 0 4px 15px;
                @if(app()->getLocale() == 'ar')   padding: 0;@endif">

                    <ul class="navbar-nav display-n-m " style="justify-content: center;">
                        <li class="nav-item dropdown">
                            <a class="@if (app()->getLocale() == 'ar') custom-a @endif  custom-b nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{app()->getLocale()}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="position: absolute; right: 1px;">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div class="langs">
                                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>

                    <div class="social-container">
                        <ul class="social-icons">
                            <li><a href="{{$setting->facebook}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{$setting->instagram}}"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="{{$setting->youtube}}"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="{{$setting->linkedin}}"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>


            </div>



        </div>
        <ul class="navbar-nav display-n-d" style="justify-content: center;">
            <li class="nav-item dropdown">
                <a class="@if (app()->getLocale() == 'ar') custom-a @endif  custom-b nav-link dropdown-toggle"
                    href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{app()->getLocale()}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                 style="position: absolute;left: -55px; padding: 5px 7px; @if (app()->getLocale() == 'ar') left: 0px; @endif ">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="langs">
                            <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                        </div>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- end of navbar -->
