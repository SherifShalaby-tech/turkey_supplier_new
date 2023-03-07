@extends('layouts.website.master')
@section('title',trans('custom.contact_us'))
@section('css')
<style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {}
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        outline: none;
    }

    a,
    a:active,
    a:focus {
        color: #333;
        text-decoration: none;
        transition-timing-function: ease-in-out;
        -ms-transition-timing-function: ease-in-out;
        -moz-transition-timing-function: ease-in-out;
        -webkit-transition-timing-function: ease-in-out;
        -o-transition-timing-function: ease-in-out;
        transition-duration: .2s;
        -ms-transition-duration: .2s;
        -moz-transition-duration: .2s;
        -webkit-transition-duration: .2s;
        -o-transition-duration: .2s;
    }

    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    img {
        max-width: 100%;
        height: auto;
    }


    .sec-title-style1 {
        position: relative;
        display: block;
        margin-top: -9px;
        padding-bottom: 50px;
    }
    .sec-title-style1.max-width{
        position: relative;
        display: block;
        max-width: 770px;
        margin: -9px auto 0;
        padding-bottom: 52px;
    }
    .sec-title-style1.pabottom50 {
        padding-bottom: 42px;
    }
    .sec-title-style1 .title {
        position: relative;
        display: block;
        color: #131313;
        font-size: 36px;
        line-height: 46px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .sec-title-style1 .title.clr-white{
        color: #ffffff;
    }
    .sec-title-style1 .decor {
        position: relative;
        display: block;
        width: 70px;
        height: 5px;
        margin: 19px 0 0;
    }
    .sec-title-style1 .decor:before{
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 5px;
        height: 5px;
        background: #44a8c2;
        border-radius: 50%;
        content: "";
    }
    .sec-title-style1 .decor:after{
        position: absolute;
        top: 0;
        right: 10px;
        bottom: 0;
        width: 5px;
        height: 5px;
        background: #44a8c2;
        border-radius: 50%;
        content: "";
    }
    .sec-title-style1 .decor span {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 1px;
        background: #44a8c2;
        margin: 2px 0;
    }


    .sec-title-style1 .text{
        position: relative;
        display: block;
        margin: 7px 0 0;
    }
    .sec-title-style1 .text p{
        position: relative;
        display: inline-block;
        padding: 0 15px;
        color: #131313;
        font-size: 22px;
        line-height: 16px;
        font-weight: 700;
        text-transform: uppercase;
        margin: 0;
    }
    .sec-title-style1 .text.clr-yellow p{
        color: #44a8c2;
    }
    .sec-title-style1 .text .decor-left{
        position: relative;
        top: -2px;
        display: inline-block;
        width: 70px;
        height: 5px;
        background: transparent;
    }
    .sec-title-style1 .text .decor-left span {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 1px;
        background: #44a8c2;
        content: "";
        margin: 2px 0;
    }
    .sec-title-style1 .text .decor-left:before{
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 5px;
        height: 5px;
        background: #44a8c2;
        border-radius: 50%;
        content: "";
    }
    .sec-title-style1 .text .decor-left:after{
        position: absolute;
        top: 0;
        right: 10px;
        bottom: 0;
        width: 5px;
        height: 5px;
        background: #44a8c2;
        border-radius: 50%;
        content: "";
    }

    .sec-title-style1 .text .decor-right{
        position: relative;
        top: -2px;
        display: inline-block;
        width: 70px;
        height: 5px;
        background: transparent;
    }
    .sec-title-style1 .text .decor-right span {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 50px;
        height: 1px;
        background: #44a8c2;
        content: "";
        margin: 2px 0;
    }
    .sec-title-style1 .text .decor-right:before{
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 5px;
        height: 5px;
        background: #44a8c2;
        border-radius: 50%;
        content: "";
    }
    .sec-title-style1 .text .decor-right:after{
        position: absolute;
        top: 0;
        left: 10px;
        bottom: 0;
        width: 5px;
        height: 5px;
        background: #44a8c2;
        border-radius: 50%;
        content: "";
    }

    .sec-title-style1 .bottom-text{
        position: relative;
        display: block;
        padding-top: 16px;
    }
    .sec-title-style1 .bottom-text p{
        color: #848484;
        font-size: 22px;
        line-height: 26px;
        font-weight: 400;
        margin: 0;
    }
    .sec-title-style1 .bottom-text.clr-gray p{
        color: #cdcdcd;
    }
    .contact-address-area{
        position: relative;
        display: block;
        background: #ffffff;
        padding: 100px 0 120px;
    }
    .contact-address-area .sec-title-style1.max-width {
        padding-bottom: 72px;
    }
    .contact-address-box{
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
    }
    .single-contact-address-box {
        position: relative;
        display: block;
        background: #131313;
        padding: 85px 30px 77px;
    }
    .single-contact-address-box .icon-holder{
        position: relative;
        display: block;
        padding-bottom: 24px;
    }
    .single-contact-address-box .icon-holder span:before{
        font-size: 75px;
    }
    .single-contact-address-box h3{
        color: #ffffff;
        margin: 0px 0 9px;
    }
    .single-contact-address-box h2{
        color: #44a8c2;
        font-size: 24px;
        font-weight: 600;
        margin: 0 0 19px;
    }
    .single-contact-address-box a{
        color: #ffffff;
    }

    .single-contact-address-box.main-branch {
        background: #44a8c2;
        padding: 53px 30px 51px;
        margin-top: -20px;
        margin-bottom: -20px;
    }
    .single-contact-address-box.main-branch h3{
        color: #131313;
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 38px;
        text-transform: uppercase;
        text-align: center;
    }
    .single-contact-address-box.main-branch .inner{
        position: relative;
        display: block;

    }
    .single-contact-address-box.main-branch .inner ul{
        position: relative;
        display: block;
        overflow: hidden;
    }
    .single-contact-address-box.main-branch .inner ul li{
        position: relative;
        display: block;
        padding-left: 110px;
        border-bottom: 1px solid #737373;
        padding-bottom: 23px;
        margin-bottom: 24px;
    }
    .single-contact-address-box.main-branch .inner ul li:last-child{
        border: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .single-contact-address-box.main-branch .inner ul li .title{
        position: absolute;
        top: 2px;
        left: 0;
        display: inline-block;
    }
    .single-contact-address-box.main-branch .inner ul li .title h4{
        color: #fff;
        font-size:22px;
        letter-spacing: 1px;
        font-weight: 100;
        line-height: 24px;
        text-transform: capitalize;
        border-bottom: 2px solid #44a8c2;
    }

    .single-contact-address-box.main-branch .inner ul li .text{
        position: relative;
        display: block;
    }
    .single-contact-address-box.main-branch .inner ul li .text p{
        color: #fff;
        font-size: 24px;
        line-height: 24px;
        font-weight: 100;
        margin: 0;
    }

    .contact-info-area {
        position: relative;
        display: block;
        background: #ffffff;
    }
    .contact-form {
        position: relative;
        display: block;
        background: #ffffff;
        padding: 100px 60px 80px;
        -webkit-box-shadow: 0px 3px 8px 2px #ededed;
        box-shadow: 0px 3px 8px 2px #ededed;
        z-index: 3;
    }
    .contact-form .sec-title-style1{
        position: relative;
        display: block;
        padding-bottom: 51px;
        width: 50%;
    }
    .contact-form .text-box{
        position: relative;
        display: block;
        margin-top: 19px;
        width: 50%;
    }
    .contact-form .text p{
        color: #848484;
        line-height: 26px;
        margin: 0;
    }

    .contact-form .inner-box{
        position: relative;
        display: block;
        background: #ffffff;
    }
    .contact-form form{
        position: relative;
        display: block;
    }
    .contact-form form .input-box{
        position: relative;
        display: block;
    }

    .contact-form form input[type="text"],
    .contact-form form input[type="email"],
    .contact-form form textarea{
        position: relative;
        display: block;
        background: #ffffff;
        border: 1px solid #eeeeee;
        width: 100%;
        height: 55px;
        font-size: 22px;
        padding-left: 19px;
        padding-right: 15px;
        border-radius: 0px;
        margin-bottom: 20px;
        transition: all 500ms ease;
    }
    .contact-form form textarea {
        height: 130px;
        padding-left: 19px;
        padding-right: 15px;
        padding-top: 14px;
        padding-bottom: 15px;
    }
    .contact-form form input[type="text"]:focus{
        color: #131313;
        border-color: #d4d4d4;
    }
    .contact-form form input[type="email"]:focus{
        color: #131313;
        border-color: #d4d4d4;
    }
    .contact-form form textarea:focus{
        color: #131313;
        border-color: #d4d4d4;
    }
    .contact-form form input[type="text"]::-webkit-input-placeholder {
        color: #848484;
    }
    .contact-form form input[type="text"]:-moz-placeholder {
        color: #848484;
    }
    .contact-form form input[type="text"]::-moz-placeholder {
        color: #848484;
    }
    .contact-form form input[type="text"]:-ms-input-placeholder {
        color: #848484;
    }
    .contact-form form input[type="email"]::-webkit-input-placeholder {
        color: #848484;
    }
    .contact-form form input[type="email"]:-moz-placeholder {
        color: #848484;
    }
    .contact-form form input[type="email"]::-moz-placeholder {
        color: #848484;
    }
    .contact-form form input[type="email"]:-ms-input-placeholder {
        color: #848484;
    }
    .contact-form form button {
        position: relative;
        display: block;
        width: 100%;
        background: #44a8c2;
        border: 1px solid #44a8c2;
        color: #fff;
        font-size: 24px;
        line-height: 55px;
        font-weight: 100;
        text-align: center;
        text-transform: capitalize;
        transition: all 200ms linear;
        transition-delay: 0.1s;
        cursor: pointer;
        letter-spacing: 1.4px;

    }

    .contact-form form button:hover{
        color: #44a8c2;
        background: #ffffff;
    }
    footer .row-list p{
        margin-left: 0;
    }
</style>

@stop
@section('content')
    <section class="contact-address-area p-5">
        <div class="container-fluid">
            <div class="sec-title-style1 text-center max-width"><!-- remove class text-center max-width  if u want make it left -->
                <div class="title">{{trans('custom.contact_us')}}</div>
                <div class="text"><div class="decor-left"><span></span></div><p>Quick Contact</p><div class="decor-right"><span></span></div></div>
            </div>

            <div class="contact-address-box row">
                <!-- =========== left  ===========
                <div class="col-sm-4 single-contact-address-box text-center">
                    <div class="icon-holder">
                    <span class="icon-clock-1">
                        <span class="path1"></span> <span class="path2"></span>   u can make text here if u want and make color #fff
                        <span class="path3"></span> <span class="path4"></span>
                        <span class="path5"></span> <span class="path6"></span>
                        <span class="path7"></span> <span class="path8"></span>
                        <span class="path9"></span> <span class="path10"></span>
                        <span class="path11"></span> <span class="path12"></span>
                        <span class="path13"></span> <span class="path14"></span>
                        <span class="path15"></span> <span class="path16"></span>
                        <span class="path17"></span> <span class="path18"></span>
                        <span class="path19"></span> <span class="path20"></span>
                    </span>
                    </div>
                    <h3>Lorem Ipsum</h3>
                    <h2>Lorem Ipsum is simply dummy</h2>
                </div>-->


                <!-- =========== center  =========== -->
                <div class="col-sm-12 single-contact-address-box main-branch">
                    <!-- <h3>Lorem Ipsum</h3> -->
                    <div class="inner">
                        <ul>
                            <li>
                                <div class="title">
                                    <h4>{{trans('custom.address')}}:</h4>
                                </div>
                                <div class="text">
                                    <p>{{$setting->company_address}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <h4>{{trans('custom.phone')}} & {{trans('custom.email')}}:</h4>
                                </div>
                                <div class="text">
                                    <p>{{$setting->phone}} <br> {{$setting->email}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- =========== right  =========== -->
                <div class="col-sm-4  text-center">

                </div>


            </div>
        </div>
    </section>

    <!-- =========== contact form =========== -->
    <section class="contact-info-area p-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="sec-title-style1 text-center max-width"> <!-- remove class text-center max-width  if u want make it left -->
                                    <div class="title">{{trans('custom.send_your_message')}}</div>
                                    <div class="text">
                                        <div class="decor-left"><span></span></div>
                                        <p>Contact Form</p>
                                        <div class="decor-right"><span></span></div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="inner-box">
                            <form id="contact-form" name="contact_form" class="default-form" action="{{route('postContactUs')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <input type="text" name="name" value="" placeholder="{{trans('custom.name')}}" required="">
                                                </div>
                                                <div class="input-box">
                                                    <input type="text" name="phone" value="" placeholder="{{trans('custom.phone')}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <input type="email" name="email" value="" placeholder="{{trans('custom.email')}}" required="">
                                                </div>
                                                <div class="input-box">
                                                    <input type="text" name="subject" value="" placeholder="{{trans('custom.subject')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="input-box">
                                            <textarea name="message" placeholder="{{trans('custom.message')}}..." required=""></textarea>
                                        </div>
                                        <div class="button-box col-3 ">
                                            <button type="submit" data-loading-text="Please wait...">{{trans('custom.send')}}<span class="flaticon-next"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@stop
