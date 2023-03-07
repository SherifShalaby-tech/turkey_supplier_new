<style>
    .social_c{

    display: flex;
    flex-wrap: nowrap;
    justify-content: flex-end;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;

}
.social-container {
  text-align: center;
}

.test-social {
  padding: 0;
  list-style: none;
  margin: .5em 1em;
  margin-bottom: 0px;
}
.test-social li {
  display: inline-block;
  margin: 0.15em;
  position: relative;
  font-size: 1em;
}
.test-social i {
  color: #fff;
  position: absolute;
  top: 9px;
left: 10px;
  transition: all 265ms ease-out;
}
.social-icons a {
  display: inline-block;
}
.test-social a:before {
  transform: scale(1);
  -ms-transform: scale(1);
  -webkit-transform: scale(1);
  content: " ";
  width: 40px;
  height: 40px;
  border-radius: 100%;
  display: block;
  background: rgb(255 255 255);
  background: linear-gradient(0deg, rgb(255 255 255) 0%, rgb(243 243 243) 100%);
  transition: all 265ms ease-out;
  /*   background: linear-gradient(45deg, #00B5F5, #002A8F); */
}


.test-socials a:hover:before {
  transform: scale(0);
  transition: all 265ms ease-in;
}

.test-social a:hover i {
  transform: scale(2);
  -ms-transform: scale(2);
  -webkit-transform: scale(2);
  background: rgb(255 255 255);
  background: linear-gradient(0deg, rgb(255 255 255) 0%, rgb(243 243 243) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: all 265ms ease-in;
}

.row-list li{
    display: block !important;

}
.p-ar{
    margin-right: 30px;
}
.p-6{
    padding: 3rem 5rem!important;
}

@media (max-width: 1400px) {
    footer .row-list p {
        font-size: 24px;
    }
    footer {
        font-size: 20px;
        font-family: CustomFont;
        letter-spacing: 1px;
        text-transform: uppercase;
        background: rgb(36,103,122);
        background: linear-gradient(0deg, rgba(36,103,122,1) 10%, rgba(92,187,213,1) 100%);
        color: #FFF !important;
        padding: 30px 0;
    }
}
@media (max-width: 990px) {

    .footer-img{
        width: 30% !important;
    }
}
@media (max-width: 768px) {
    .p-6{
         padding: 0rem 0rem!important;
    }
    .footer-img{
        width: 30% !important;
    }
}

@media (max-width: 425px) {
    .p-6{
         padding: 0rem 0rem!important;
    }
    .footer-img{
        width: 50% !important;
    }
}


@media (max-width: 375px) {
    .p-6{
         padding: 0rem 0rem!important;
    }
    .footer-img{
        width: 50% !important;
    }
}


@media (max-width: 320px) {
    .p-6{
         padding: 0rem 0rem!important;
    }
    .footer-img{
        width: 50% !important;
    }
}

@font-face {
font-family: "test";
src: url("http://127.0.0.1:8000/website/fonts/SofiaSans-SemiBold.ttf");
        }
</style>

<!-- footer -->
<footer class="mt-4">
    <div class="container-fluid">
        <!-- row -->

        <!-- end of row -->
        <div class="row row-list for-p" style="    align-items: baseline;">

            <div class="col-lg-2 col-mg-2 col-xl  col-12-sm  logo">
                <img src="{{asset('website/imgs/Group.png')}}"  style="width: 100%;" class="footer-img wobble-horizontal ">
            </div>
            <!-- col -->
            <div class="col-xl col-12-sm col-sm-4 col-6">
                <p class="grow @if (app()->getLocale() == 'ar') p-ar @endif">{{trans('custom.Customer_services')}}</p>
                <ul>
                    <li class="grow"><a href="{{route('helpCenter')}}">{{trans('custom.Help_Center')}}</a></li>

                    <li class="grow"><a href="{{route('policesRoles')}}">{{trans('custom.Policies_Rules')}}</a></li>

                </ul>
            </div>
            <!-- end of col-->
            <div class="col-xl col-12-sm col-sm-4 col-6">
                <p class="grow @if (app()->getLocale() == 'ar') p-ar @endif">{{trans('custom.About_Us')}}</p>
                <ul>
                    <li class="grow"><a href="{{route('about_us')}}">{{trans('custom.Turkey_Suppliers')}}</a></li>
                
                    <li class="grow"><a href="{{route('contactUs')}}">{{trans('custom.Contact_us')}}</a></li>
                </ul>
            </div>
            <!-- end of col-->
            <div class="col-xl col-12-sm col-sm-4 col-6">
                <p class="grow @if (app()->getLocale() == 'ar') p-ar @endif">{{trans('custom.Source_on_Turkey_Supplies')}}</p>
                <ul>
                    <li class="grow"><a href="{{route('categories.index')}}">{{trans('custom.All_Categories')}}</a></li>
                    <li class="grow"><a href="{{route('getSellers')}}">{{trans('custom.suppliers')}}</a></li>
                </ul>
            </div>
            <!-- end of col-->
            <div class="col-xl col-12-sm col-sm-4 col-6">
                <p class="grow @if (app()->getLocale() == 'ar') p-ar @endif">{{trans('custom.Sell_On_Site')}}</p>
                <ul>
                    <li class="grow"><a href="{{route('membership')}}">{{trans('custom.Supplier_Memberships')}}</a></li>
                </ul>
            </div>
            <!-- end of col-->
            <div class="col-xl col-12-sm col-sm-4 col-12">
                <p class="grow @if (app()->getLocale() == 'ar') p-ar @endif" >{{trans('custom.services')}}</p>
                <ul>
                    <li class="grow"><a href="{{route('tradeShow')}}">{{trans('custom.trade_show')}}</a></li>
                    <li class="grow"><a href="{{route('mediation')}}">{{trans('custom.Mediation')}}</a></li>
                    <li class="grow"><a href="{{route('translationServices')}}">{{trans('custom.translationServices')}}</a></li>
                    <li class="grow"><a href="{{route('shipping')}}">{{trans('custom.shipping')}}</a></li>
                </ul>
            </div>
            <!-- end of col-->
        </div>

        <hr>

    </div>


    <div class="style-container">
        <div class="container">
            <div class="row" style="display: flex; flex-wrap: wrap;justify-content: center; align-items: center;">
                @php
                    $setting = \App\Models\Setting::first();
                @endphp
                <div class="mt-3 col-lg-4 col-md-4 col-xl-4 col-sm-12">
                    <div class="social-container test-social">
                        <ul class="social-icons">
                            <li><a href="{{$setting->facebook}}"><i class="fa fa-facebook" style="color: #004190;"></i></a></li>
                            <li><a href="{{$setting->instagram}}"><i class="fa fa-instagram" style="color: rgb(158,2,244);
                                                                        color: linear-gradient(172deg, rgba(158,2,244,1) 7%, rgba(205,1,231,1) 23%, rgba(252,0,217,1) 43%,
                                                                        rgba(255,0,44,1) 60%, rgba(255,102,0,1) 78%, rgba(255,209,0,1) 92%);"></i></a></li>
                            <li><a href="{{$setting->youtube}}"><i class="fa fa-youtube" style="color: #f00; left: 6px;"></i></a></li>
                            <li><a href="{{$setting->linkedin}}"><i class="fa fa-linkedin" style="color:#1178c9"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-xl-8 col-sm-12 subscripe">
                    <h4>{{trans('custom.Trade_Alert_Delivering_the_latest_product_trends_and_industry_news_straight_to_your_inbox')}}</h4>
                    <form action="{{route('subscribe')}}" method="POST">
                        @csrf
                        <div class="row" style="margin: 0 !important; padding: 0;">
                            <div class="col-xl-9 col-sm-12" style="margin: 0 !important; padding: 0;">
                                <input required="required" name="email" placeholder="{{trans('custom.email')}}" type="email" class="form-control" style=" padding:10px 5px;">
                            </div>
                            <div class="col-xl-3 col-sm-12">
                                <button type="submit">{{trans('custom.Subscribe')}}</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>




    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="stext-106 cl0 txt-center p-t-20">
                    COPYRIGHT TURKEY SUPPLIERS &copy;<script>document.write(new Date().getFullYear());</script> | made
                    by <a class="copyright-a cl0 hov-cl1" href="https://sherifshalaby.tech/" target="_blank"> sherifshalaby.tech </a>
                </p>
            </div>
        </div>
    </div>
    <script src="{{asset('website/js/jquery-3.4.1.js')}}"></script>
    <script>
        $(".img-user").click(function(){
            if($(".user_hover_div").hasClass('hide')){
                $(".user_hover_div").removeClass('hide');
                $(".user_hover_div").css('display','inline-block');
            }else{
                $(".user_hover_div").addClass('hide');
                $(".user_hover_div").css('display','none');
            }

        });
    </script>
    <script>
        $("#search_product").on('keyup',function(){
            let value = $(this).val();
            $.ajax({
                url: "{{route('product.search')}}",
                type:'GET',
                data:{
                    'name' : value
                },
                success:function(data){
                    if(value == ''){
                        $("#product-result").addClass('d-none');
                    }else{
                        $("#product-result").removeClass('d-none');
                        $("#product-result").html(data);
                    }
                }
            });
            // let res_sear = $(".list-group-item");
            // for (let i=0;i < res_sear.length;i++){
            //     res_sear[i].onclick = function(){
            //         alert('done');
            //         $("#search_product").val(res_sear[i].text());
            //     }
            // }
        });
    </script>
</footer>
<!-- end of footer -->
