<style>

    a{
        text-decoration: none !important;
    }

   /* .social_c{

        display: flex;
        flex-wrap: nowrap;
        justify-content: flex-end;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        background-color: #fff;
        padding: 4px 27px;
        margin-right: -15px;
        position: relative;
        left: 520px;
    }
    .social_c-ar{
        padding: 4px 16px;
        right: 603px;
    }*/
    .social-container {
      text-align: center;
      padding-top: 5px;
    }

    .social-icons {
      padding: 0;
      list-style: none;
      margin: .5em .5em;
      margin-bottom: 0px;
      margin-top: 0px;
    }
    .social-icons li {
      display: inline-block;
      margin: 0 0.15em;
      position: relative;
      font-size: 1.2em;
    }
    .social-icons i {
      color: #fff;
      position: absolute;
      top: 11px;
    left: 11px;
      transition: all 265ms ease-out;
    }
    .social-icons a {
      display: inline-block;
    }
    .social-icons a:before {
      transform: scale(1);
      -ms-transform: scale(1);
      -webkit-transform: scale(1);
      content: " ";
      width: 40px;
      height: 40px;
      border-radius: 100%;
      display: block;
      background: rgb(56 149 172);
      background: linear-gradient(0deg, rgb(65 164 190) 0%, rgb(44 136 161) 100%);
      transition: all 265ms ease-out;
      /*   background: linear-gradient(45deg, #00B5F5, #002A8F); */
    }
    .social-icons a:hover:before {
      transform: scale(0);
      transition: all 265ms ease-in;
    }
    .social-icons a:hover i {
      transform: scale(2);
      -ms-transform: scale(2);
      -webkit-transform: scale(2);
      background: rgb(56 149 172);
      background: linear-gradient(0deg, rgb(65 164 190) 0%, rgb(44 136 161) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      transition: all 265ms ease-in;
    }


    /* */    /* */
    .navbar-nav .nav-item .custom-b{
        padding: 5px 0px 5px 12px;
    background: rgb(56 149 172);
    background: linear-gradient(0deg, rgb(65 164 190) 0%, rgb(44 136 161) 100%);
    border-radius: 10%;
    color: #fff !important;
    width: 60px !important;
    font-size: 22px !important;
    }
    .navbar-nav .nav-item .custom-a{
        padding: 5px 18px 5px 0px;
    background: rgb(56 149 172);
    background: linear-gradient(0deg, rgb(65 164 190) 0%, rgb(44 136 161) 100%);
    border-radius: 10%;
    color: #fff !important;
    width: 70px !important;
    }

    .service-p{
        font-size: 24px;
    }
/* */
.search-input{
    border-radius:50px;
    color: #44a8c2 !important;
}
.search-input::placeholder{

    color: #44a8c2 !important;
}
.search-btn{
    width: 18%;
    padding: 4px;
    border-radius:50px;
    background-color: #44a8c2 !important;
    border: none;
    display: inline-block;
    position: relative;
    right: 133px;
    top: 0;
}
.search-btn-ar{
    right: -133px;
}
.list-group li a {
    color: #44a8c2;
}

    #form {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: flex-end;
  position: relative;
}

#form button {
  font-size: 20px;
  border-radius: 50px;
  position: absolute;
  padding: 4px 10px 0 18px;
  right: 0;
  height: 100%;
  background-color: #44a8c2 !important;
  border: none;
}
#form .btn-se-ar{
    left: 0;
    right: auto;
    padding: 4px 20px 0 14px;
}
#form img {
  position: absolute;
  right: 110px;
  height: 80%;
}

#form .img-se-ar{
    right: auto;
    left: 100px;
}

#form input {
  width: 100%;
  border-radius: 50px;
  font-size:18px !important;
}

#forminput:focus {
  outline: none;
  box-shadow: none;
  border: 0;
}
 /* */

    @media (min-width: 1200px){
        .style-container .container {
            max-width: 1700px !important;
        }
    }

    @media (min-width: 1440px) {
        .style-container .row{
            margin: 0px 10px !important
        }
        .navbar-light .nav-link{
        font-size: 25px !important;
        padding: 0 4px !important;
        }

    }


    @media (max-width: 1400px) {
        .style-container .row{
            margin: 0px 40px !important;
        }
        .navbar-light .nav-link {
        color: #FFF !important;
        font-weight: 100 !important;
        font-size: 20px !important;
    }

    }


    @media (max-width: 1200px) {

     .style-container .container {
            width: 100%;
            max-width: 1100px !important;
            margin: 0px 0 0 10px
            padding: 0;
        }
         .style-container .row {
            margin: 0px !important;
        }
    }

    @media  (max-width : 1024px) {
        .style-container .container{
            width: 100%;
            max-width: 998px  !important;
            margin: 0 0 0 12px;
            padding: 0;
        }
        .search-btn-ar {
            right: 270px !important;
        }

        .navbar-nav .nav-item .custom-b {
            font-size: 17px !important;
        }

        .navbar-light .nav-link {
        color: #FFF !important;
        font-weight: 100 !important;
        padding-right: 4px !important;
            padding-left: 0 !important;
            font-size: 14px !important;
        }
        .logo{
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            align-items: center;
        }
        .navbar-nav .nav-item .custom-a{
                width: 50px !important;
          }
          .card-title-name {
            width: 190px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-title{
            font-size: 24px !important;
        }

    }

@media (max-width: 992px) {
    .header  .row{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: nowrap;
        margin-right: -15px;
        margin-left: -15px;
        justify-content: space-around;
        margin: 0 50px !important;
        letter-spacing: .5px !important;
    }
    .style-container .container {
        width: 100%;
        max-width: 900px !important;
        margin: 0px 0 0 45px;
        padding: 0;
    }
         .style-container .row {
            margin: 0px !important;
        }
    .search-input{
      width: 100% !important;
    }

    .navbar-nav {
        padding-left: 10px;
    }

    }

    @media (max-width: 980px){
        .card-title-name {
            width: 170px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }

@media (max-width: 768px) {
    .header  .row{
      margin: 20px !important;
    }
    .header .row .logo-flex{
        display: flex;
       justify-content: center;
    }
    .style-container .container {
           max-width: 700px !important;
           margin: 0px 0 0 33px;
             padding: 0;
         }
    .style-container .container-ar {
            max-width: 700px !important;
            margin: 0 33px 0 0 !important;
            padding: 0;
        }

    .search-input {
            width: 90% !important;
        }

    .style-container .container {
        max-width: 700px !important;
        margin: 0px 0 0 33px;
        padding: 0;
    }
    .price_text{
        font-size: 16px !important;
    }
    .navbar-light .nav-link{

        font-size: 22px !important;
        }
        .card-title {
    font-size: 22px !important;
}
}

@media (max-width: 767px) {
    .header  .row{
     display: contents;
    }
    .header .row .logo-flex{
        display: flex;
       justify-content: center;
    }
    .price_text{
        font-size: 16px !important;
    }

}


@media (max-width: 576px) {
    .header .row{
        display: contents;
    }

    .style-container .container {
            width: 100%;
            max-width: 540px !important;
            margin: 0 0 0 18px;
            padding: 0;
         }
         .style-container .row {
            margin: 0px !important;
        }
        .price_text{
        font-size: 16px !important;
    }
}

@media (max-width: 575px) {
    .header   .row{
    margin: 0 !important;
    display: contents;
  }

  .search-input{
    width: 90% !important;
  }
  .header .row{
        margin: 0 !important;
    }
    .price_text{
        font-size: 16px !important;
    }
}

@media (max-width: 480px) {
    .header  .row{
        margin: 0 !important;
        display: flex !important;
        -ms-flex-wrap: wrap !important;
        flex-wrap: wrap !important;
        margin-right: -15px ;
        margin-left: -15px;
        justify-content: space-around !important;
    }

    .search-input{
        width: 90% !important;
    }container-ar

    .navbar-nav {
        padding-left: 10px;
    }
    .header .row{
        margin: 0 !important;
    }
    .price_text{
        font-size: 16px !important;
    }
}

@media (max-width: 425px){
    .style-container .container {
        width: 100%;
        max-width: 400px !important;
        margin: 0px 0 0 12px;
        padding: 0;
    }
    .style-container .container-ar {
        max-width: 390px !important;
        margin: 0 15px 0 0 !important;
    }
    .test-lang{
        padding: 0 !important;
    }
    .test-lang-ar{
        margin-right: 25px;
    }
    .navbar-light .nav-link {
        color: #FFF !important;
        font-weight: 100 !important;
        padding-right: 5px !important;
        padding-left: 0 !important;
        font-size: 20px !important;
    }
    .navbar-nav .nav-item .custom-b {

    padding-left: 14px !important;
    }
    .navbar-nav .nav-item .custom-a {

    padding-right: 8px !important;
    }

    .price_text{
        font-size: 16px !important;
    }
    .card-title {
        font-size: 17px !important;
    }
    .style-container .best-seller-img p {
        font-size: 22px;
    }
    #form input {
         font-size:14px !important;
    }
}

@media (max-width: 390px) {
        .style-container .container {
            width: 100%;
            max-width: 345px !important;
            margin: 0px 0 0 14px !important;
            padding: 0;
         }
         .style-container .container-ar {
            width: 100%;
            max-width: 335px !important;
            margin: 0px 16px 0 0 !important;
            padding: 0;
         }
         .style-container .row {
            margin: 0px !important;
        }
        .test-lang{
            padding: 0 !important;

        }
        .test-lang-ar{
        margin-right: 25px;
    }
    .card-title {
    font-size: 20px !important;
}
        .navbar-light .nav-link {
            color: #FFF !important;
            font-weight: 100 !important;
            padding-right: 5px !important;
            padding-left: 0 !important;
            font-size: 20px !important;
        }
        .navbar-nav .nav-item .custom-b {

            padding-left: 14px !important;
        }

        .navbar-nav .nav-item .custom-b {

            padding-right: 10px !important;
        }
        .price_text{
            font-size: 14px !important;
        }
        .card-title-name {
            width: 60px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .style-container .swiper .swiper-slide img {
            height: 60px !important;
        }
        .style-container .swiper .swiper-slide{
             height: 150px !important
         }
    }

@media (max-width: 320px) {
        .style-container .container {
            width: 100%;
            max-width: 290px !important;
            margin: 0 0 0 15px;
            padding: 0;
         }
         .style-container .row {
            margin: 0px !important;
        }
        .price_text{
            font-size: 14px !important;
        }
        .style-container .swiper .swiper-slide img {
            height: 60px !important;
        }
        .style-container .swiper .swiper-slide{
             height: 150px !important
         }
         .card-title {
    font-size: 20px !important;
}
    }




</style>



<!-- header -->
<div class="header mt-3 mb-3  ">
    <!-- container -->
    <div class="container-fluid container-ar">
        <!-- row -->
        <div class="row" style="margin: 0 20px; font-family:CustomFont; letter-spacing: 1px; align-items: center;">

            <div class="col-lg-4 col-md-4 col-12">
                <div class="logo">
                    <a class="logo-flex" href="{{route('website.index')}}">
                        <img src="{{asset('website/imgs/Group.png')}}" width="150">
                    </a>
                    <a href="{{route('website.index')}}" style="font-size: 28px; font-weight: bold; color:#44a8c2;">
                        TURKEYSUPPLIERS.ONLINE
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12" style="@if(app()->getLocale() == 'ar') margin-left: 0px; @endif" >
                <div class="form  ">
                    <form  id="form" action="{{route('product.public.search')}}" method="GET">
                        <input required="required" autocomplete="off" name="name" type="search" class="form-control search-input" id="search"
                         placeholder="{{trans('custom.What are you searching for')}} ?..."  >
                         <img class="@if(app()->getLocale() == 'ar') img-se-ar @endif" width="25" src="{{asset('website/imgs/cam.png')}}">
                        <button class=" @if (app()->getLocale() == 'ar') btn-se-ar @endif"
                            type="submit">{{trans('custom.search')}} <i class="fa fa-search"></i>
                        </button>
                    </form>
                    <div id="product-result"></div>
                </div>
            </div>




            <div class="col-lg-2 col-md-2 col-12">
                <div class="options " style="display: flex;
                flex-wrap: nowrap;
                justify-content: center;
                align-items: center;">
                    @if(Auth::guard('company')->user())
                        <img class="img-user pulse-grow" src="{{asset('website/imgs/user.png')}}" width="50">
                        <div class="user_hover_div hide">
                            <p>Welcome  {{Auth::guard('company')->user()->name  ?? null}} </p>
                            {{-- @if(!auth('company')->user())
                                <div class="mb-2">
                                    <button type="button" class="btn btn-primary"><a style="color: #FFF;text-decoration: none" href="{{route('webLogin')}}">Sigin In</a></button>
                                </div>
                                <div class="mb-2">
                                    <button type="button" class="btn btn-primary"><a style="color: #FFF;text-decoration: none" href="{{route('webRegister')}}">Join Us Now</a></button>
                                </div>
                                <div class="login-social text-center">
                                    <hr style="border-color: #333">
                                    <a href="{{route('social.redirectToProvider','facebook')}}">
                                        <img src="{{asset('imgs/Facebook.svg')}}">
                                    </a>
                                    <a href="{{route('social.redirectToProvider','google')}}">
                                        <img src="{{asset('imgs/Google.svg')}}">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('imgs/Linkedin.svg')}}">
                                    </a>
                                </div>
                            @endif --}}
                            <hr style="border-color: #333">
                            <div class="user_hover_links">
                                @if(Auth::guard('company')->user()->trade_role == 'seller')
                                <div>
                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                    <a href="{{route('admin.home')}}">{{trans('custom.mydash')}}</a>
                                </div>
                                @endif
                                <div>
                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                    <a href="{{route('user.orders')}}">{{trans('custom.orders')}}</a>
                                </div>
                                <div>
                                    <span><img src="{{asset('website/imgs/Vector.png')}}"></span>
                                    <a href="{{route('user.fav',auth('company')->user()->id)}}">{{trans('custom.fav')}}</a>
                                </div>
                                <div>
                                    <span><img src="{{asset('website/imgs/Group 30.png')}}"></span>
                                    <a href="{{route('buyer.profile',auth('company')->user()->id)}}">{{trans('custom.account')}}</a>
                                </div>
                                <div class="ml-1">
                                    <span><i class="fa fa-lock"></i></span>
                                    <a href="{{route('web.logout')}}">{{trans('custom.logout')}}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::guard('admin')->user())
                        <img class="img-user pulse-grow" src="{{asset('website/imgs/user.png')}}" width="50">
                        <div class="user_hover_div hide">
                            <p>Welcome  {{Auth::guard('admin')->user()->name  ?? null}} </p>
                            <hr style="border-color: #333">
                            <div class="user_hover_links">
                                <div>
                                    <span><img src="{{asset('website/imgs/Group 32.png')}}"></span>
                                    <a href="{{route('admin.home')}}">{{trans('custom.mydash')}}</a>
                                </div>
                                <div class="ml-1">
                                    <span><i class="fa fa-lock"></i></span>
                                    <a  href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                        {{ __('custom.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    <a href="{{route('messages.suppliers.show')}}"> <img src="{{asset('website/imgs/chat.png')}}" width="50" class="pulse-grow"> </a>
                    <a href="{{route('cart.get.products')}}"><img src="{{asset('website/imgs/cart.png')}}" width="50" class="pulse-grow"></a>
                    <a href="{{route('user.orders')}}"><img src="{{asset('website/imgs/orders.png')}}" width="50" class="pulse-grow"></a>
                </div>
            </div>

        </div>
        <!-- end of row -->
    </div>
    <!-- end of container -->
</div>
