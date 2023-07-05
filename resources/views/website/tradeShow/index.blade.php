@extends('layouts.website.master')
@section('title',trans('custom.trade_show'))
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#">{{trans('tradeshows.tradeshows')}} </a>
        </p>
    </div>
</div>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
                <div class="p-b-10 separator">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                            {{trans('tradeshows.tradeshows')}}
                        </h3>
                    </div>
                </div>
        <div class="container">
			<div class="row isotope-grid">

                @if($tradeShow->count() > 0)
                    @foreach($tradeShow as $tradeShow)
                        <div class="col-sm-6 col-md-4 col-lg-4 p-b-35 isotope-item women  txt-center ">
                            <div class="col-12 bg-input1">
                            <!-- Block2 -->
                                <div class="block2">

                                    <div class="block2-pic hov-img0 p-lr-30">
                                        <a href="{{$tradeShow->linkurl}}">

                                        @if($tradeShow->firstMedia)
                                            <img class="circle-img " src="{{ asset('images/tradeShows/'.$tradeShow->firstMedia->file_name) }}" alt="{{ $tradeShow->title }}"
                                                    style="left:0%;">
                                        @else
                                            <img class="circle-img" src="{{ asset('images/no-image.png') }}" alt="{{ $tradeShow->title }}"
                                                style="left:0%; ">
                                        @endif
                                        </a>
                                    </div>
                                    <div class="block2-txt flex-w flex-t p-t-14 txt-center flex-c-m">
                                        <div class="flex-col-c  txt-center">
                                            <a target="_blank" href="{{$tradeShow->linkurl}}" class="mtext-105 cl2 hov-cl1 trans-04 js-name-b2 p-b-12 " style="    height: 120px;">
                                                {{$tradeShow->title}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 
                    @endforeach
                @else
                        <div class="col-12 col-md-12 col-lg-12 m-lr-auto txt-center">
                            <p class="mtext-101 text-danger">There are no results !</p>
                        </div>
               @endif

			</div>
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101  size-103   hov-btn1 p-lr-15 trans-04 btn bg1 cl0 mtext-108">
					Load More
				</a>
			</div>
		</div>
	</section>

@stop
