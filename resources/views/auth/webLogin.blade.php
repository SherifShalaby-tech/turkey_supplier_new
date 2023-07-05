@extends('layouts.website.master')
@section('title','Login')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    @if(app()->getLocale() == 'ar')
        <style>
            .form-check-input{
                margin-right: -1.25rem;
            }
        </style>
    @endif

<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;

    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        font-size: 33px;
        font-weight: bold;
        position: relative;
        left: 47%;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

@stop
@section('content')

<section class="bg0 p-t-23 p-b-140">
    <div class="container ">
        <div class="row">

            <div class="col-lg-6 col-md-6  col-12 img9 flex-c-m">
                <img src="{{asset('imgs/image 9.png')}}">
                @if (app()->getLocale() == 'tr')
                    <img src="{{ asset('website/imgs/logint (2).png') }}">
                @else
                    <img src="{{ asset('website/imgs/LOGIN.png') }}">
                @endif
                
            </div>

            <div class="col-md-6 col-lg-6 col-12 m-tb-50 p-tb-20 border-solid">

                <h2 class="form_title title txt-center p-tb-20"> {{trans('custom.login')}}</h2>

                <a class="flex-w  flex-c-m" href="" onclick="loginFun()">
                    <div class="flex-w  p-lr-30  mtext-1075">
                        <input class="cl1" type="radio" name="slide" id="login" >
                        <label class="p-lr-10 cl2" for="login" class="slide login">{{trans('custom.buyer')}}</label>
                    </div>

                    <div class="flex-w  mtext-1075 ">
                        <input  class="cl1" type="radio" name="slide" id="signup" checked>
                        <label  class="p-lr-10 cl2" for="signup" class="slide signup">{{trans('custom.supplier')}}</label>
                    </div>
                </a>

                <div class="p-b-10 p-t-40  " id="user">
                    <form class="form aForm" id="a-form" action="{{ route('user.post.login') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 p-lr-100 ">
                                <div class="form-group mtext-1075">

                                    <input required="required" name="email" type="email"  id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="{{trans('custom.email')}}" class=" form-control bg-input1 ">
                                </div>
                            </div>
                            <div class="col-md-12  p-lr-100  ">
                                <div class="form-group mtext-1075 row" style="width: 100%; margin-left: 5px;">
                                    {{-- <div class="row"> --}}
                                    <input required="required" name="password" type="password"  id="exampleInputPassword1"
                                     placeholder="{{trans('custom.password')}}" class="form-control bg-input1">
                                     <i class="far fa-eye" id="togglePassword1" style="margin-left: -30px; cursor: pointer; margin-top: 10px;"></i>

                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-md-12 p-lr-100  ">
                                <div class="form-group mtext-1075 flex-w flex-sb-m ">
                                    <div class="flex-w  p-lr-30">
                                        <input name="remember" type="checkbox" id="exampleCheck1" value="1" class="form-control bg-input1" style="width: auto;">
                                        <label class="p-lr-10">{{trans('custom.stay_sign_in')}}</label>
                                    </div>
                                    <div class="flex-w">
                                        <a class="cl4" href="#" id="forgotBtn"> {{trans('custom.forgot_password')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 p-t-30">
                            <div class="col-md-12 txt-center">
                                <div class="form-group mtext-1075">
                                    <button type="submit" class="btn bg1 cl0 p-tb-18 p-lr-100 bor2color" >{{trans('custom.sign_in')}}</button>
                                </div>
                            </div>
                            <div class="col-md-12 txt-center">
                                <div class="form-group mtext-1075">
                                    <a class="cl2 mtext-1075 flex-c-m" href="{{route('webRegister')}}">
                                        {{trans('custom.not_member')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="p-b-10 p-t-40 " id="company" style="display: none">
                    <form class="form bForm" id="b-form" action="{{ route('user.post.login') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 p-lr-100 ">
                                <div class="form-group mtext-1075">

                                    <input required="required" name="email" type="email"  id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="{{trans('custom.email')}}" class="form-control bg-input1">
                                </div>
                            </div>
                            <div class="col-md-12  p-lr-100  ">
                                <div class="form-group mtext-1075 row" style="width: 100%; margin-left: 5px;">
                                    <input required="required" name="password" type="password"  id="exampleInputPassword2"
                                     placeholder="{{trans('custom.password')}}" class="form-control bg-input1">
                                     <i class="far fa-eye" id="togglePassword2" style="margin-left: -30px; cursor: pointer; margin-top: 10px;"></i>
                                </div>
                            </div>
                            <div class="col-md-12 p-lr-100  ">
                                <div class="form-group mtext-1075 flex-w flex-sb-m ">
                                    <div class="flex-w  p-lr-30">
                                        <input name="remember" type="checkbox" id="exampleCheck1" value="1" class="form-control bg-input1" style="width: auto;">
                                        <label class="p-lr-10">{{trans('custom.stay_sign_in')}}</label>
                                    </div>
                                    <div class="flex-w">
                                        <a class="cl2" href="#" id="forgotBtn"> forgot password ?</a>
                                    </div>
                                </div>
                            </div>

                      
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-social flex-w flex-sb-m mtext-1075">
                                    <a class="p-tb-16 p-lr-40 m-tb-20   bor2color cl2" href="{{route('social.redirectToProvider','facebook')}}">
                                        <i class="fa-brands fa-facebook-f"></i>
                                        Facebook
                                    </a>

                                    <a  class="p-tb-16 p-lr-40 m-tb-20  bor2color cl2" href="{{route('social.redirectToProvider','google')}}">
                                        <i class="fa-solid fa-m"></i>
                                        G-mail
                                    </a>

                                    <a  class="p-tb-16 p-lr-40 m-tb-20   bor2color cl2" href="{{route('social.redirectToProvider','linkedin')}}">
                                        <i class="fa-brands fa-linkedin"></i>
                                        Linkedin
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 p-t-30">
                            <div class="col-md-12 txt-center">
                                <div class="form-group mtext-1075">
                                    <button type="submit" class="btn bg1 cl0 p-tb-18 p-lr-100 bor2color" >{{trans('custom.sign_in')}}</button>
                                </div>
                            </div>
                            <div class="col-md-12 txt-center">
                                <div class="form-group mtext-1075">
                                    <a class="cl2 mtext-1075 flex-c-m" href="{{route('webRegister')}}">
                                        Not a member yet?    sign up
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>



<!-- The Modal -->
<div id="forgotModal" class="modal flex-c-m">

    <!-- Modal content -->
    <div class=" img9 flex-c-m" style=" position: relative; top: 20%;">
        <div class="modal-content flex-c-m">

            <span class="close">&times;</span>
            <div class="p-b-10 p-t-30">
                <h2 class="txt-center p-tb-20"> {{trans('custom.Forgot_your_password?')}} </h2>


                <p class="txt-center p-tb-20">Enter your email and recover your account</p>


                <form class="form aForm" id="a-form" action="{{ route('buyer.reset.password') }}" method="GET">
                    @csrf
                    <div class="row">
                        {{-- <div class="col-md-12 p-lr-100 ">
                            <div class="form-group mtext-1075">

                                <input name="phone" type="text"  id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="{{trans('custom.phone_number')}}" class=" form-control bg-input1 ">
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-12 flex-c-m txt-center div-border  m-t-20 m-b-30 p-lt-100" >  <p class="p-position flex-c-m txt-center"> OR </p> </div> --}}

                        <div class="col-md-12 p-lr-100 ">
                            <div class="form-group mtext-1075">

                                <input required="required" name="email" type="email"  id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="{{trans('custom.email')}}" class=" form-control bg-input1 ">
                            </div>
                        </div>


                    </div>
                    <div class="row mt-2 p-t-30">
                        <div class="col-md-12 txt-center">
                            <div class="form-group mtext-1075">
                                <button type="submit" class="btn bg1 cl0 p-tb-18 p-lr-100 bor2color" >{{trans('custom.Reset_password')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>







    <script>
        function loginFun() {
            var x = document.getElementById("user");
            var y = document.getElementById("company");

            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            } else {
                x.style.display = "none";
                y.style.display = "block";
            }
        }


        // Get the modal
        var modal = document.getElementById("forgotModal");

        // Get the button that opens the modal
        var btn = document.getElementById("forgotBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none"; 
        }
        }

        const togglePassword1 = document.querySelector('#togglePassword1');
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password1 = document.querySelector('#exampleInputPassword1');
        const password2 = document.querySelector('#exampleInputPassword2');

        togglePassword1.addEventListener('click', function (e) {
            // toggle the type attribute
            const type1 = password1.getAttribute('type') === 'password' ? 'text' : 'password';
            password1.setAttribute('type', type1);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
        togglePassword2.addEventListener('click', function (e) {
            // toggle the type attribute
            const type2 = password2.getAttribute('type') === 'password' ? 'text' : 'password';
            password2.setAttribute('type', type2);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

@stop
