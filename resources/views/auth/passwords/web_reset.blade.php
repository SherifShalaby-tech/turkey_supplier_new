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
            </div>

            <div class="col-md-6 col-lg-6 col-12 m-tb-50 p-tb-20 border-solid">

                <h2 class="form_title title txt-center p-tb-20"> {{trans('custom.Reset_password')}}</h2>

                <div class="p-b-10 p-t-40  " id="user">
                    <form class="form aForm" id="a-form" action="{{ route('post.password') }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="row">
                            <div class="col-md-12 p-lr-100 ">
                                <div class="form-group mtext-1075">

                                    <input required="required" name="email" type="email"  id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="{{trans('custom.email')}}" class=" form-control bg-input1 ">
                                </div>
                            </div>
                            <div class="col-md-12  p-lr-100  p-lr-0-md ">
                                <div class="form-group mtext-1075 row" style="width: 100%; margin-left: 5px;">
                                    <input required="required" name="password" type="password"  id="exampleInputPassword2"
                                     placeholder="{{trans('custom.password')}}" class="form-control bg-input1">
                                     <i class="far fa-eye" id="togglePassword2" style="margin-left: -30px; cursor: pointer; margin-top: 10px;"></i>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12  p-lr-100   p-lr-0-md">
                                <div class="form-group mtext-1075 row" style="width: 100%; margin-left: 5px;">
                                    <input required="required" name="confirm_password" type="password"  id="exampleInputPassword1"
                                     placeholder="{{trans('custom.confirm_password')}}" class="form-control bg-input1">
                                     <i class="far fa-eye" id="togglePassword1" style="margin-left: -30px; cursor: pointer; margin-top: 10px;"></i>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row mt-2 p-t-30">
                            <div class="col-md-12 txt-center">
                                <div class="form-group mtext-1075">
                                    <button type="submit" class="btn bg1 cl0 p-tb-18 p-lr-100 bor2color" >{{trans('custom.sign_in')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</section>







    <script>
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
