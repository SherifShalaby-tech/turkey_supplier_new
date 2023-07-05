@extends('layouts.website.master')
@section('title',trans('custom.membership'))
@section('content')
<style>
.card__side--front-1 {

background: rgb(155,226,235);
background: linear-gradient(135deg, rgba(155,226,235,1) 0%, rgba(46,178,195,1) 100%);

}
.card__side--front-2 {
    background: rgb(58,189,220);
background: linear-gradient(180deg, rgba(58,189,220,1) 0%, rgba(45, 152, 179, 0.904) 53%);
}
.card__side--front-3 {

background: rgb(22,153,184);
background: linear-gradient(180deg, rgba(22,153,184,1) 0%, rgba(39,137,160,1) 55%);
}
</style>
<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#">{{trans('custom.membership')}} </a>
        </p>
    </div>
</div>

</section>
    <div class="bg0 p-t-23 p-b-140">
        <div class="p-b-50 separator">
            <div class="flex-center bg1 p-0  b-rt-lb-20">
                <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                    {{trans('custom.membership')}}
                </h3>
            </div>
        </div>

        <div class="container-fluid p-lr-100 p-r-0-md p-l-0-md">
           
            <div class="row">
                @if($plans->count() > 0)
                    @foreach($plans as $plan)
                        <div class="col-1-of-3 col-lg-4 col-sm-12 col-md-6 mb-3 wobble-horizontal ">
                            <div class="bg-card">
                            <a href="{{route('webRegister')}}">
                                <div class="card">
                                    <div class="card__side card__side--front-{{$plan->id}}">
                                        <div class="card__title card__title--2">
                                            <h2 class="cl0 p-b-20">{{$plan->title}}</h2>
                                            <h3 class="card__heading">{{$plan->price}} USD</h3>
                                            <span class="cl0 mtext-107 ">yearly</span>
                                        </div>

                                        <div class="card__details">
                                            <ul class="cl0">
                                                <li> <i class="fa-solid fa-check"></i>  {{$plan->character_count ?? '-'}} {{trans('plans.character_count')}}</li>
                                                <li> <i class="fa-solid fa-check"></i>  {{$plan->company_picture_count ?? '-'}} {{trans('plans.company_picture_count')}}</li>
                                                
                                                @if ($plan->product_count >= 10000)
                                                    <li> <i class="fa-solid fa-check"></i>  {{trans('plans.unlimited')}}  {{trans('plans.product_count')}}</li>
                                                @else
                                                    <li> <i class="fa-solid fa-check"></i> {{$plan->product_count ?? ''}} {{trans('plans.product_count')}}</li>
                                                @endif
                                                <li> <i class="fa-solid fa-check"></i> {{$plan->product_picture_count ?? ''}} {{trans('plans.product_picture_count')}}</li>
                                                <li> <i class="fa-solid fa-check"></i> {{$plan->video_count ?? ''}} {{trans('plans.video_count')}}</li>
                                                <li> <i class="fa-solid fa-check"></i> {{$plan->speacial_customer ?? ''}} {{trans('plans.speacial_customer')}}</li>
                                            </ul>
                                        </div>

                                        @check_guard
                                        <div class="m-lr-auto txt-center p-t-10 p-b-20">
                                            <a href="{{route('webLogin')}}" class="btn bg1 cl0 mtext-108">{{trans('custom.get_started')}}</a>
                                        </div>
                                        @endcheck_guard
                                    </div>
                                </div>
                            </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-5 alert alert-danger">
                        <p class="text-danger">Plans not found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>


@stop
