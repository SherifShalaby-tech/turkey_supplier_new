@extends('layouts.website.master')
@section('title',trans('custom.mediation'))
@section('content')

    <div class="bg0 p-t-10 p-b-20">
        <div class="container-fluid">
            <p class="cl6">
                <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
                /
                <a  class="cl6" href="#"> {{trans('custom.Mediation')}} </a>
            </p>
        </div>
    </div>
    
	<section class="bg0 p-t-75 p-b-120">
		<div class="container-fluid">

            @forelse(App\Models\Mediation::get() as $mediation)
                <div class="row p-b-148">

                    <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                        <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                            <div class="  ">
                                <div class="block2-pic hov-img0">
                                    <img src="{{asset('images/mediations/' . $mediation->image)}}" alt="Card image cap"
                                        style="
                                        border-radius: 30px; right:0;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 txt-center m-t-40">
                        <div class="p-tb-16 p-r-85 p-l-85 p-r-15-lg border-dot m-r-20 m-l-20 p-lr-0-md m-lr-0-md">
                            <p class="ltext-101 cl2 p-b-26">
                                {!! $mediation->description !!}

                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 col-md-12 col-lg-12 m-lr-auto txt-center">
                        <p class="mtext-101 text-danger">Mediation not found</p>
                    </div>
                </div>
            @endforelse

            <div class="col-12 col-md-12 col-lg-12 m-lr-auto txt-center p-t-30 ">
                <a href="{{route('mediation_request')}}" class="btn bg1 cl0 mtext-108">{{trans('custom.mediation_request')}}</a>
            </div>

		</div>
	</section>	
	
		
@stop
