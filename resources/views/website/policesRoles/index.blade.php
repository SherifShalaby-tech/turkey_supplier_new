@extends('layouts.website.master')
@section('title',trans('custom.Policies_Rules'))
@section('content')
    <div class="Policies_Rules text-center p-5">
        <div class="container-fluid">
            <h2 class="mb-3">{{trans('custom.Policies_Rules')}}</h2>
            <div class="row">
                @if($rules->count() > 0)
                    @foreach($rules as $rule)
                        <div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                            <div class="card" style="text-align: start;">
                                {{--                                <img class="card-img-top" src="{{asset('images/translation_services/70624576download.png')}}" alt="Card image cap">--}}
                                <div class="card-body" style="font-size: 22px;">
                                    <h2 class="card-title" style="color: #44a8c2">{{$rule->title}}</h2>
                                    <p class="card-text" >
                                        <pre>
                                            {!! $rule->description !!}
                                        </pre>
                                    </p>
                                    {{--                                <a href="#" class="btn btn-primary">Go somewhere</a>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-5 alert alert-danger">
                        <p class="text-danger">not found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>


@stop
