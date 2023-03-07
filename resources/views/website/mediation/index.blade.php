@extends('layouts.website.master')
@section('title',trans('custom.mediation'))
@section('content')
<style>

        @media (min-width: 1600px){
                        .container {
                max-width: 1500px;
            }
        }

  
</style>
    <div class="mediation  p-5">
        <div class="container-fluid">
            <div class=" mb-3 text-center">
                <h2 >{{trans('custom.Mediation')}}</h2>
                <a href="{{route('mediation_request')}}" class="btn" style="background-color: #45aac4 !important; color:#fff; font-size: 24px; 
                letter-spacing: 1px; font-weight: 100;">{{trans('custom.mediation_request')}}</a>
            </div>

            <div class="row">
                {{-- @if($mediations->count() > 0) --}}
                    @forelse(App\Models\Mediation::get() as $mediation)
                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3 text-center">
                            <div class="card" style="width: 80%;">
                                <img class="card-img-top" src="{{asset('images/mediations/' . $mediation->image)}}" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">{{$mediation->title}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12 col-md-6 mb-3 mt-2">
                            <div class="card" >
                                <div class="card-body">
                                    <pre>
                                        <h3 class="card-title">{!! $mediation->description !!}</h3>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-5 alert alert-danger">
                            <p class="text-danger">Mediation not found</p>
                        </div>
                    @endforelse
                {{-- @else --}}
                {{-- @endif --}}
            </div>
        </div>
    </div>


@stop
