@extends('layouts.website.master')
@section('title','edit profile')
@section('content')


<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.edit_profile')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-23 p-b-140">
        <div class="p-b-10 separator">
            <div class="flex-center bg1 p-0  b-rt-lb-20">
                <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                    {{trans('custom.edit_profile')}}
                </h3>
            </div>
        </div>
    <div class="container">
        <div class="p-b-10 p-t-40 ">

            <form action="{{route('buyer.update.profile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mtext-1075">
                            <label for="exampleInputEmail1">{{trans('custom.username')}}</label>
                            <input name="name" value="{{$user->name}}" type="text" class="form-control bg-input1" id="exampleInputEmail1">
                        </div>

                        <div class="form-group mtext-1075">
                            <label for="exampleInputEmail1"> {{trans('custom.email')}}</label>
                            <input name="email" value="{{$user->email}}" type="email" class="form-control bg-input1" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group mtext-1075">
                            <label for="exampleInputPassword1">{{trans('custom.new_password')}}</label>
                            <input name="new_password" type="password" class="form-control bg-input1" id="exampleInputPassword1">
                        </div>
                    </div>

                <div class="col-lg-6 col-sm-12">
                    <br>
                      <div class="form-group mtext-1075">
                          <label for="exampleInputPassword1">{{trans('custom.phone')}}</label>
                          <input name="phone" value="{{$user->phone}}" type="text" class="form-control bg-input1" id="exampleInputPassword1">
                      </div>
                      <div class="form-group mtext-1075">
                          <label for="exampleFormControlTextarea1"> {{trans('custom.bio')}}</label>
                          <textarea name="description" class="form-control bg-input1" id="exampleFormControlTextarea1" rows="3">{{$user->description}}</textarea>
                        </div>
                      <button type="submit" class="btn bg-btn1">{{trans('custom.save')}}</button>
                  </div>
                </div>
            </form>

        </div>
    </div>
</section>


@stop
