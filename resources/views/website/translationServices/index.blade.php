@extends('layouts.website.master')
@section('title',trans('custom.translation_services'))
@section('content')
    <div class="translation_services p-5">
        <div class="container-fluid">
            <div class=" mb-3 text-center">
                <h2>{{trans('custom.translationServices')}}</h2>
                <a href="{{route('translationServicesRequest')}}" class="btn  text-center "  
                    style="background-color: #45aac4 !important; color:#fff; letter-spacing: 1px; font-size: 24px;
                font-weight: 100;">{{trans('custom.translation_services_request')}}</a>
            </div>
            <div class="row">
                {{-- @if($translationServices->count() > 0) --}}
                    @forelse($translationServices as $translationService)
                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3  text-center ">
                            <div class="card" style="width: 80%;">
                                @if($translationService->image)
                                <img class="card-img-top" src="{{asset('images/translations/'.$translationService->image)}}" alt="Card image cap">
                                @else
                                <img src="{{ asset('images/Logo.jpg') }}" alt="{{ $translationService->name }}" class="img-thumbnail" width="100px">
                                @endif

                                <div class="card-body">
                                    <h3 class="card-title">{{$translationService->title}}</h3>
{{--                                    <p class="card-text">{!! $translationService->description !!}</p>--}}

                                    {{--                                <a href="#" class="btn btn-primary">Go somewhere</a>--}}
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-8 col-sm-12 col-md-6 mb-3 mt-2">
                        <div class="card" >
                            <div class="card-body">
                                <pre>
                                    <h3 class="card-title">{!! $translationService->description !!}</h3>

                                </pre>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="p-5 alert alert-danger">
                            <p class="text-danger">Translation services not found</p>
                        </div>
                    @endforelse
                {{-- @else --}}
                {{-- @endif --}}
            </div>
        </div>
    </div>


@stop
