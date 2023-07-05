@extends('layouts.website.master')
@section('title','products')
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="{{route('categories.index')}}">{{trans('custom.categories')}} </a>
            /
            <a  class="cl6" href="#">{{trans('custom.sub_categories')}} </a>
        </p>
    </div>
</div>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
                <div class="p-b-10 separator">
                    <div class="flex-center bg1 p-0  b-rt-lb-20">
                        <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                            {{trans('custom.sub_categories')}}
                        </h3>
                    </div>
                </div>
        <div class="container-fluid">
			<div class="row  ">

                @if(isset($category->subCategories))
                @forelse($category->subCategories as $sub_cat)
                        <div class="col-sm-6 col-md-3 col-lg-3 col-6 p-b-35 isotope-item   txt-center ">
                            <div class="col-12  ">
                            <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0 p-lr-10  p-lr-0-md p-tb-0">
                                        <a href="{{route('subcategory.products',$sub_cat->id)}}">
                                            @if($sub_cat->image)
                                                <img src="{{asset('images/sub_categories/' . $sub_cat->image)}}"
                                                        style="left:0%;top:0%; border-radius: 20px; ">
                                            @else
                                                <img  src="{{asset('images/no-image.png')}}"  
                                                    style="left:0%;top:0%; border-radius: 20px; ">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="block2-txt  p-t-7">
                                        <div class=" flex-col-l p-r-l-5">
                                            <a href="{{route('subcategory.products',$sub_cat->id)}}"
                                                class="card-title-name-home-cat p-r-l-10 mtext-105 cl2 hov-cl4 f-s-s-r trans-04 js-name-b2  w-full">
                                                {{$sub_cat->name ?? null}}
                                            </a>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                 
                        @empty
                        <div class="error-not-found">
                            <div class="not-found-msg">
                                <p class="alert alert-danger stext-105 ">{{trans('custom.products_not_found')}}</p>
                            </div>
                        </div>
                @endforelse

                @else
                    <div class="error-not-found">
                        <div class="not-found-msg">
                            <p class="alert alert-danger stext-105 ">{{trans('custom.products_not_found')}}</p>
                        </div>
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
