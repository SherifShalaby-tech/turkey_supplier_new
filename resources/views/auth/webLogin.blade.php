@extends('layouts.website.master')
@section('title','Login')
@section('css')
    @if(app()->getLocale() == 'ar')
        <style>
            .form-check-input{
                margin-right: -1.25rem;
            }
        </style>
    @endif
@stop
@section('content')

<style>

        .main {

        position: relative;

        width: 1000px;
        min-width: 1000px;
        min-height: 600px;
        height: 600px;
        padding: 25px;
        background-color: #ecf0f3;
        box-shadow: 10px 10px 10px #d1d9e6, -10px -10px 10px #f9f9f9;
        border-radius: 12px;
        overflow: hidden;
       /* margin: 100px 0px 100px 700px; */
        }
        .login .row{
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: nowrap;
            margin-right: -15px;
            margin-left: -15px;
            justify-content: center;
            align-items: center;
        }
        .login .img9 {
            display: contents;
        }
        @media (max-width: 1200px) {
        .main {
            transform: scale(0.7);
        }
        }
        @media (max-width: 1000px) {
            .main {
               /* transform: scale(0.5); */
            padding: 0;
            margin: 0;

        }
        .login .row{
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            justify-content: center;
            align-items: center;
         }
        }
        @media (max-width: 800px) {
        .main {
               /* transform: scale(0.5); */
            padding: 0;
            margin: 0;

        }
        .login .row{
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            justify-content: center;
            align-items: center;
         }
        }
        @media (max-width: 600px) {
        .main {
            transform: scale(0.4);
            margin: 0;
            padding: 0;
        }
        .login {
            padding: 0;
        }
        .login img{
           display: none;
        }
        }

        .containerlogin {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        right: 0;
        width: 600px;
        height: 100%;
        padding: 25px;
        background-color: #ecf0f3;
        transition: 1.25s;
        }

        .containerlogin .form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        height: 100%;
        }
        .containerlogin .form__icon {
        object-fit: contain;
        width: 30px;
        margin: 0 5px;
        opacity: 0.5;
        transition: 0.15s;
        }
        .containerlogin .form__icon:hover {
        opacity: 1;
        transition: 0.15s;
        cursor: pointer;
        }
        .containerlogin .form__input {
        width: 350px;
        height: 40px;
        margin: 4px 0;
        padding-left: 25px;
        font-size: 13px;
        letter-spacing: 0.15px;
        border: none;
        outline: none;
        font-family:  CustomFont;;
        background-color: #ecf0f3;
        transition: 0.25s ease;
        border-radius: 8px;
        box-shadow: inset 2px 2px 4px #d1d9e6, inset -2px -2px 4px #f9f9f9;
        }
        .containerlogin .form__input:focus {
        box-shadow: inset 4px 4px 4px #d1d9e6, inset -4px -4px 4px #f9f9f9;
        }
        .containerlogin .form__span {
        margin-top: 30px;
        margin-bottom: 12px;
        }
        .containerlogin .form__link {
        color: #181818;
        font-size: 15px;
        margin-top: 25px;
        border-bottom: 1px solid #a0a5a8;
        line-height: 2;
        }

        .containerlogin .title {
        font-size: 34px;
        font-weight: 100;
        line-height: 3;
        color: #181818;
        }

        .containerlogin .description {
        font-size: 14px;
        letter-spacing: 0.25px;
        text-align: center;
        line-height: 1.6;
        }

        .button {
        width: 180px;
        height: 50px;
        border-radius: 10px;
        margin-top: 5px;
        font-weight: 100;
        font-size: 18px;
        letter-spacing: 1.15px;
        background-color: #ffffff;
        color: #3b9db6;
        padding: 0;
        box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #f9f9f9;
        border: #3b9db6 1px solid;
        outline:  #3b9db6 1px solid;
        }

        /**/
        .a-container {
        z-index: 100;
        left: calc(100% - 600px );
        }

        .b-container {
        left: calc(100% - 600px );
        z-index: 0;
        }

        .switch {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 400px;
        padding: 50px;
        z-index: 200;
        transition: 1.25s;
        background-color: #ecf0f3;
        overflow: hidden;
        box-shadow: 4px 4px 10px #d1d9e6, -4px -4px 10px #f9f9f9;
        }
        .switch__circle {
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background-color: #ecf0f3;
        box-shadow: inset 8px 8px 12px #d1d9e6, inset -8px -8px 12px #f9f9f9;
        bottom: -60%;
        left: -60%;
        transition: 1.25s;
        }
        .switch__circle--t {
        top: -30%;
        left: 60%;
        width: 300px;
        height: 300px;
        }
        .switch__container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        position: absolute;
        width: 400px;
        padding: 50px 55px;
        transition: 1.25s;
        }
        .switch__button {
        cursor: pointer;
        }
        .switch__button:hover {
        box-shadow: 6px 6px 10px #d1d9e6, -6px -6px 10px #f9f9f9;
        transform: scale(0.985);
        transition: 0.25s;
        }
        .switch__button:active, .switch__button:focus {
        box-shadow: 2px 2px 6px #d1d9e6, -2px -2px 6px #f9f9f9;
        transform: scale(0.97);
        transition: 0.25s;
        }

        /**/
        .is-txr {
        left: calc(100% - 400px );
        transition: 1.25s;
        transform-origin: left;

        }

        .is-txl {
        left: 0;
        right:  450px;
        transition: 1.25s;
        transform-origin: right;
        }

        .is-z200 {
        z-index: 200;
        transition: 1.25s;
        }

        .is-hidden {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        transition: 1.25s;
        }

        .is-gx {
        animation: is-gx 1.25s;
        }

        @keyframes is-gx {
        0%, 10%, 100% {
            width: 400px;
        }
        30%, 50% {
            width: 500px;
        }
        }
</style>
<div class="login {{app()->getLocale() == 'ar' ? 'ltr' : ''}}" >
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-4  col-sm-12 img9">
                <img src="{{asset('imgs/image 9.png')}}">
            </div>

    <div class="main col-lg-8 col-md-8  col-sm-12">

        <div class="containerlogin a-container  " style="@if(app()->getLocale() == 'ar')   @endif" id="a-container">

          <form class="form" id="a-form" action="{{ route('user.post.login') }}" method="POST">
              @csrf
            <h2 class="form_title title">User Login</h2>
            <div class="form-group form-check">
                <label for="exampleInputEmail1">{{trans('custom.email')}}</label>
                <input class="form__input form-control" required="required" name="email" type="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{trans('custom.email')}}">
            </div>
            <div class="form-group form-check">
                <label for="exampleInputPassword1">{{trans('custom.password')}}</label>
                <input class="form__input form-control" required="required" name="password" type="password"  id="exampleInputPassword1" placeholder="{{trans('custom.password')}}">
            </div>
            <div class="form-group form-check">
                <input name="remember" type="checkbox" class="form-check-input" id="exampleCheck1" value="1">
                <label class="form-check-label" for="exampleCheck1">{{trans('custom.stay_sign_in')}}</label>
            </div>

            <div class="mb-2">
                <button type="submit" class="form__button button ">{{trans('custom.sign_in')}}</button>
            </div>
            <div class="mb-2">
                <a style="color: #FFF;text-decoration: none" href="{{route('webRegister')}}">
                <button type="button" class="form__button button ">
                    {{trans('custom.join_us')}}</button>
                </a>
            </div>

            <div class="login-social text-center">
                <p class="text-center">{{trans('custom.sign_in_with')}}</p>
                <a href="{{route('social.redirectToProvider','facebook')}}">
                    <img src="{{asset('imgs/Facebook.svg')}}">
                </a>
                <a href="{{route('social.redirectToProvider','google')}}">
                    <img src="{{asset('imgs/Google.svg')}}">
                </a>
                <a href="{{route('social.redirectToProvider','linkedin')}}">
                    <img src="{{asset('imgs/Linkedin.svg')}}">
                </a>
            </div>

          </form>
        </div>

        <div class="containerlogin b-container" id="b-container">
          <form class="form" id="b-form" action="{{ route('user.post.login') }}" method="POST">
            @csrf
            <h2 class="form_title title">Company Login</h2>

            <div class="form-group form-check">
                <label for="exampleInputEmail1">{{trans('custom.email')}}</label>
                <input class="form__input form-control" required="required" name="email" type="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{trans('custom.email')}}">
            </div>
            <div class="form-group form-check">
                <label for="exampleInputPassword1">{{trans('custom.password')}}</label>
                <input class="form__input form-control" required="required" name="password" type="password"  id="exampleInputPassword1" placeholder="{{trans('custom.password')}}">
            </div>
            <div class="form-group form-check">
                <input name="remember" type="checkbox" class="form-check-input" id="exampleCheck1" value="1">
                <label class="form-check-label" for="exampleCheck1">{{trans('custom.stay_sign_in')}}</label>
            </div>

            <div class="mb-2">
                <button type="submit" class="form__button button ">{{trans('custom.sign_in')}}</button>
            </div>
            <div class="mb-2">
                <a style="color: #FFF;text-decoration: none" href="{{route('webRegister')}}">
                <button type="button" class="form__button button ">
                    {{trans('custom.join_us')}}</button>
                </a>
            </div>

            <div class="login-social text-center">
                <p class="text-center">{{trans('custom.sign_in_with')}}</p>
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

          </form>
        </div>

        <div class="switch" id="switch-cnt">
          <div class="switch__circle"></div>
          <div class="switch__circle switch__circle--t"></div>
          <div class="switch__container" id="switch-c1">
            <h2 class="switch__title title">Welcome Back !</h2>
            <p class="switch__description description">Enter your personal details and start journey with us</p>
            <button class="switch__button button switch-btn" style="background-color: #3b9db6 ; color:#FFF">Company Login</button>
          </div>
          <div class="switch__container is-hidden" id="switch-c2">
            <h2 class="switch__title title">Welcome Back !</h2>
            <p class="switch__description description">Enter your personal details and start journey with us</p>
            <button class="switch__button button switch-btn" style="background-color: #3b9db6;  color:#FFF">User Login</button>
          </div>
        </div>
      </div>

        </div>
    </div>
</div>


    <script>
        let switchCtn = document.querySelector("#switch-cnt");
        let switchC1 = document.querySelector("#switch-c1");
        let switchC2 = document.querySelector("#switch-c2");
        let switchCircle = document.querySelectorAll(".switch__circle");
        let switchBtn = document.querySelectorAll(".switch-btn");
        let aContainer = document.querySelector("#a-container");
        let bContainer = document.querySelector("#b-container");
        let allButtons = document.querySelectorAll(".submit");

        let getButtons = (e) => e.preventDefault()

        let changeForm = (e) => {

            switchCtn.classList.add("is-gx");
            setTimeout(function(){
                switchCtn.classList.remove("is-gx");
            }, 1500)
            switchCtn.classList.toggle("is-txr");
            switchCircle[0].classList.toggle("is-txr");
            switchCircle[1].classList.toggle("is-txr");

            switchC1.classList.toggle("is-hidden");
            switchC2.classList.toggle("is-hidden");
            aContainer.classList.toggle("is-txl" );
            bContainer.classList.toggle("is-txl" );
            bContainer.classList.toggle("is-z200");
        }

        let mainF = (e) => {
            for (var i = 0; i < allButtons.length; i++)
                allButtons[i].addEventListener("click", getButtons );
            for (var i = 0; i < switchBtn.length; i++)
                switchBtn[i].addEventListener("click", changeForm)
        }

        window.addEventListener("load", mainF);
    </script>

@stop
