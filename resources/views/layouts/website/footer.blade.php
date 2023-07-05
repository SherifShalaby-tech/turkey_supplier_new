@php
    $setting = \App\Models\Setting::first();
@endphp

<footer class="bg2 p-t-75">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-2 col-lg-2 p-b-30">
                <img src="{{asset('website/imgs/Group.png')}}"  style="width: 60%;" class="wobble-horizontal">

            </div>

            <div class="col-sm-2 col-lg-2 p-b-30">
                <h4 class="latotext-108 cl5 p-b-30">
                    {{trans('custom.Customer_services')}}
                </h4>

                <ul>
                    <li class="p-b-10 grow">
                        <a class="stext-116 cl2 trans-04" href="{{route('helpCenter')}}">{{trans('custom.Help_Center')}}</a>
                    </li>
                    <li class="p-b-10 grow">
                        <a class="stext-116 cl2 trans-04" href="{{route('policesRoles')}}">{{trans('custom.Policies_Rules')}}</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-2 col-lg-2 p-b-30">
                <h4 class="latotext-108 cl5 p-b-30">
                    {{trans('custom.About_Us')}}
                </h4>
                <ul>
                    <li class="p-b-10 grow">
                        <a class="stext-116 cl2  trans-04" href="{{route('about_us')}}">{{trans('custom.Turkey_Suppliers')}}</a>
                    </li>
                    <li class="p-b-10 grow">
                        <a class="stext-116 cl2  trans-04" href="{{route('contactUs')}}">{{trans('custom.Contact_us')}}</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-2 col-lg-2 p-b-30">
                <h4 class="latotext-108 cl5 p-b-30">
                    {{trans('custom.Source_on_Turkey_Supplies')}}
                </h4>

                <ul>
                    <li class="p-b-10 grow">
                        <a class="stext-116 cl2 trans-04" href="{{route('categories.index')}}">{{trans('custom.All_Categories')}}</a>
                    </li>
                    <li class="p-b-10 grow">
                        <a class="stext-116 cl2 trans-04" href="{{route('getSellers')}}">{{trans('custom.suppliers')}}</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-2 col-lg-2 p-b-30">
                <h4 class="latotext-108 cl5 p-b-30">
                    {{trans('custom.Sell_On_Site')}}
                </h4>
                <ul>
                    <li class="p-b-10 grow">
                        <a class="stext-116 cl2 trans-04" href="{{route('membership')}}">{{trans('custom.Supplier_Memberships')}}</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-2 col-lg-2 p-b-30">
                <h4 class="latotext-108 cl5 p-b-30">
                    {{trans('custom.services')}}
                </h4>

                <ul>
                    <li class="p-b-10 grow"><a class="stext-116 cl2 trans-04" href="{{route('tradeShow')}}">{{trans('custom.trade_show')}}</a></li>
                    <li class="p-b-10 grow"><a class="stext-116 cl2 trans-04" href="{{route('mediation')}}">{{trans('custom.Mediation')}}</a></li>
                    <li class="p-b-10 grow"><a class="stext-116 cl2 trans-04" href="{{route('translationServices')}}">{{trans('custom.translationServices')}}</a></li>
                    <li class="p-b-10 grow"><a class="stext-116 cl2 trans-04"href="{{route('shipping')}}">{{trans('custom.shipping')}}</a></li>
                </ul>
            </div>

        </div>

        <div class="row">
            
            <div class="col-sm-6 col-lg-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d5164.095767973298!2d28.722635464341543!3d40.98074047344472!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNDDCsDU4JzQ4LjAiTiAyOMKwNDMnMjMuNyJF!5e0!3m2!1sen!2seg!4v1678892151604!5m2!1sen!2seg"
                 width="95%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>



            <div class="col-sm-6 col-lg-6 p-lr-20" style="display: grid;align-items: center;">
                <div class="p-b-20">
                    <h4 class="mtext-101 cl5 p-b-30 cl11">
                        {{trans('custom.Trade_Alert_Delivering_the_latest_product_trends_and_industry_news_straight_to_your_inbox')}}
                    </h4>
                    <form action="{{route('subscribe')}}" method="POST">
                        @csrf
                        <div class="row" style="margin: 0 !important; padding: 0;">
                            <div class="col-xl-9 col-sm-12" style="margin: 0 !important; padding: 0;">
                                <input required="required" name="email" placeholder="{{trans('custom.email')}}" type="email" class="form-control" style=" padding:10px 5px;">
                            </div>
                            <div class="col-xl-3 col-sm-12">
                                <button class="bg1 cl0 p-tb-7 p-lr-20" type="submit">{{trans('custom.send')}}</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="row">
                    <ul class="social-icons ">
                        <li><a href="{{$setting->facebook}}"><i class="fa fa-facebook" style="color: #004190;"></i></a></li>
                        <li><a href="{{$setting->instagram}}"><i class="fa fa-instagram" style="color: rgb(158,2,244);
                                                                    color: linear-gradient(172deg, rgba(158,2,244,1) 7%, rgba(205,1,231,1) 23%, rgba(252,0,217,1) 43%,
                                                                    rgba(255,0,44,1) 60%, rgba(255,102,0,1) 78%, rgba(255,209,0,1) 92%);"></i></a></li>
                        <li><a href="{{$setting->youtube}}"><i class="fa fa-youtube" style="color: #f00; left: 6px;"></i></a></li>
                        <li><a href="{{$setting->linkedin}}"><i class="fa fa-linkedin" style="color:#1178c9"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="bg1 clp-t-40 p-all-10 cl0 ">
            <p class="stext-116 cl0 txt-center fs-18">
                COPYRIGHT TURKEY SUPPLIERS &copy;<script>document.write(new Date().getFullYear());</script> | made  by 
                <a class="stext-116 cl0" href="https://sherifshalaby.tech/" target="_blank"> sherifshalaby.tech </a>
            </p>
        </div>
    </div>
</footer>