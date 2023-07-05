@extends('layouts.website.master')
@section('title',trans('custom.contact_us'))
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.Contact_us')}} </a>
        </p>
    </div>
</div>


<section class="bg0 p-t-5 p-b-120">
    <div class="container-fluid">

       
            <div class="row p-b-10 p-t-0">
                <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                    <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                        <div class="hov-img0 txt-center">
                        
                                <img class="circle-img txt-center"  src="{{ asset('website/imgs/Group.png') }}" alt="about-img"
                                    style="max-width: 100%;  height: auto; width: 50% !important;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: 50% 50%;
                                    padding: 20px;">

                                    <p class="cl11 mtext-114 p-b-20">TURKEYSUPPLIERS.ONLINE</p>
                            
                        </div>                
                    </div>
                </div>
            </div>  

                <div class="p-b-10 separator">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.Quick_Contact')}}
                        </h3>
                    </div>
                </div>

            <div class="row p-b-70 flex-c-m ">
                <div class="col-md-4 col-lg-4 txt-start m-t-40 bg10 box-shadow-0-10-10 bor2 p-all-20">
                    <div class="col-12 bg-input1 cl2 mtext-108">       
                        <p>  <i class="fa-solid fa-address-card"></i> {{  $setting->company_address}}</p>
                    </div>
                    <div class="col-12 bg-input1 cl2 m-t-20 m-b-20 mtext-108">  
                        <p> <i class="fa-solid fa-phone"></i> {{  $setting->phone}}</p>
                    </div>
                    <div class="col-12 bg-input1 cl2 mtext-108">  
                        <p> <i class="fa-solid fa-envelope"></i> {{ $setting->email}}</p>
                    </div>
                </div>
            </div>  

            <div class="p-b-10 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.contact_us')}}
                    </h3>
                </div>
            </div>


            
            <div class="row p-b-0 flex-c-m ">
                <div class="col-md-10 col-lg-10 txt-start m-t-40 bg0  p-all-20">
                    <form id="contact-form" name="contact_form" class="default-form" action="{{route('postContactUs')}}" method="POST">
                        @csrf
                        <div class="col-12">
                            <div class="form-group mtext-1075">  
                                <input   type="text" id="projectinput1" class="form-control bg-input1" name="name"
                                         placeholder="{{trans('custom.name')}}" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mtext-1075">  
                                <input   type="text" id="projectinput1" class="form-control bg-input1" name="phone"
                                         placeholder="{{trans('custom.phone')}}" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mtext-1075">  
                                <input   type="email" id="projectinput1" class="form-control bg-input1" name="email"
                                         placeholder="{{trans('custom.email')}}" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mtext-1075">  
                                <input   type="subject" id="projectinput1" class="form-control bg-input1" name="subject"
                                         placeholder="{{trans('custom.subject')}}" >
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mtext-1075">
                                <textarea id="" cols="30" rows="4" name="message" class="form-control bg-input1" placeholder="{{trans('custom.message')}}..."> {{trans('custom.message')}}...</textarea>
                            </div>
                        </div>

                        <div class="form-actions mtext-1075  txt-center">
                            <button type="submit" class="btn bg-btn1">
                                {{trans('custom.send')}}
                            </button>
                        </div>
                    </form> 
 
                </div>
            </div>  

        
    </div>
</section>	


@stop
