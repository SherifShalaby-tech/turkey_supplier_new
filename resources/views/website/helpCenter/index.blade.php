@extends('layouts.website.master')
@section('title',trans('custom.Help_Center'))
@section('content')
    <div class="help_center text-center p-5">
        <div class="container-fluid">
            <h2 class="mb-3">{{trans('custom.Help_Center')}}</h2>
            <div class="row">
                @if($help_center->count() > 0)
                    @foreach($help_center as $help)
                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                            <div class="card" style="width: 80%;">
                                <img class="card-img-top" src="{{asset('images/helpcenter/' . $help->image)}}" alt="Card image cap">
                                <div class="card-body">
                                      </pre>
                                        <h3 class="card-title">{{$help->title}}</h3>
                                    </pre>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12 col-md-6 mb-3 mt-2">
                            <div class="card" style="width: 80%;border: none">
                                <div class="card-body">
                                    <pre>
                                    <h3 class="card-title">{!! $help->description !!}</h3>
                                </pre>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-5 alert alert-danger">
                        <p class="text-danger">{{trans('custom.not_found')}}</p>
                    </div>
                @endif
            </div>



        </div>
    </div>

@stop
