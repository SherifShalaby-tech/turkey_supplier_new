@extends('layouts.website.master')
@section('title','edit profile')
@section('content')

<style>
    .btn-3{
        background-color: #3797b1;
        color: #fff;
        width: 150px;
    }
    form {
        font-size: 22px;
    }
    form input {
                font-family: arial !important;
                font-weight: 600 !important;
                font-size: 16px !important;
            }
    form textarea {
        font-family: arial !important;
        font-weight: 600 !important;
        font-size: 16px !important;

    }
    form button {
        font-size: 20px !important;
    }

    .inquiries_and_quotes .form-group-ar {
            text-align: right;
        }
</style>
<section class="p-5">
    <div class="container-fluid">
            <form action="{{route('buyer.update.profile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <h3> {{trans('custom.edit_profile')}}</h3>
                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                        <label for="exampleInputEmail1">{{trans('custom.username')}}</label>
                        <input name="name" value="{{$user->name}}" type="text" class="form-control" id="exampleInputEmail1">
                    </div>

                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                        <label for="exampleInputEmail1"> {{trans('custom.email')}}</label>
                        <input name="email" value="{{$user->email}}" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                        <label for="exampleInputPassword1">{{trans('custom.old_password')}}</label>
                        <input name="old_password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                        <label for="exampleInputPassword1">{{trans('custom.new_password')}}</label>
                        <input name="new_password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <br>
                      <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                          <label for="exampleInputPassword1">{{trans('custom.phone')}}</label>
                          <input name="phone" value="{{$user->phone}}" type="text" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="form-group @if (app()->getLocale() == 'ar') form-group-ar @endif">
                          <label for="exampleFormControlTextarea1"> {{trans('custom.bio')}}</label>
                          <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$user->description}}</textarea>
                        </div>
                      <button type="submit" class="btn btn-3">{{trans('custom.save')}}</button>
                  </div>
                </div>
            </form>


    </div>
</section>


@stop
