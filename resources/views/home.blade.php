@extends('layouts.website.master')

@section('content')


    <div class="container bootstrap snippets bootdey">
        <div class="header">
          <h3 class="text-muted prj-name">
              <span class="fa fa-users fa-2x"></span>
              المستخدمين
          </h3>
        </div>

        <div class="jumbotron" style="min-height:400px;height:auto;width:700px">
            @if($users->count() > 0)

          <ul class="list-group" id="users">
            @foreach($users as $user)
              <li class="list-group-item user-item text-left" style="width:500px">
                  <img class="img-circle img-ussser img-thumbnail " src="https://bootdey.com/img/Content/avatar/avatar7.png">
                  <h3>
                    <a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}" data-user="{{ $user->username }}">{{ $user->username }}</a>
                  </h3>
              </li>
              @endforeach
          </ul>
          @else
          <p>No users found! try to add a new user using another browser by going to <a href="{{ url('register') }}">Register page</a></p>
      @endif
        </div>
        </div>


    @include('chat-box')

    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
    <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
    <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
@stop

@section('js')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>

@stop
