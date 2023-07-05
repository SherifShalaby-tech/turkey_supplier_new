@extends('layouts.website.master')
@section('title',trans('custom.suppliers'))
@section('content')
<style>
    .isotope-item nav {
        margin: auto;
    }
</style>
<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#">{{trans('custom.suppliers')}} </a>
        </p>
    </div>
</div>

@php
    $categories = \App\Models\Category::get();
@endphp


<section class="bg0 p-t-62 p-b-60">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 col-lg-3 p-b-80 p-r-50 p-l-70 ">
                <div class="side-menu">
                    <div class="p-b-10 separator m-b-20">
                        <div class="flex-center bg1 p-0  b-rt-lb-20">
                            <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                                {{trans('custom.filter')}}
                            </h3>
                        </div>
                    </div>
                    <div class="bor17 of-hidden pos-relative">
                            <form action="{{route('categories.index')}}" method="GET">
                                <input type="search" class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55"
                                placeholder="search By Category name" name="name" id='name' required value="{{old('name',request()->name)}}" />
                                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04" type="submit" value="search">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                        </form>
                    </div>

                    <div class="p-t-55">
                        <h4 class="mtext-112 cl2 p-b-33">
                            {{trans('custom.ALL_SUPPLIERS')}}
                        </h4>

                        <ul>
                            {{-- <form action="{{route('getSellers')}}" method="GET"> --}}
                                @foreach($categoriesWithSellerCount as $category)
                                    <li class="bor18">
                                        <a  class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-tb-2">
                                            <span class="flex-w">
                                                <input class="check category"  type="checkbox" value="{{$category->id}}">
                                                <label class="p-lr-10"> {{  $category->name}} </label>
                                            </span>

                                            <span>
                                                {{$category->seller_count}}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            {{-- </form> --}}
                        </ul>
                    </div>



                </div>
            </div>

            <div class="col-md-9 col-lg-9 p-b-80"  @if(! isset($ctegorySubliers)) hidden @endif id="div-filter-suppliers">
                <div class="p-0 p-r-0-lg">
                    <div class="p-b-10 separator m-b-20">
                        <div class="flex-center bg1 p-0  b-rt-lb-20">
                            <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                                {{trans('custom.suppliers')}}
                            </h3>
                        </div>
                    </div>
                        <div class="row isotope-grid">
                            <div class="col-12 col-md-11 col-lg-11 p-b-35 isotope-item women row"  id="updateDiv" >
                                @if(isset($ctegorySubliers))
                                    @if($ctegorySubliers->count() > 0)
                                        @foreach($ctegorySubliers as $seller)
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-6 m-lr-10 m-lr-0-md  p-b-35 isotope-item women txt-center ">
                                                <!-- Block2 -->
                                                <div class="block2" style="filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                                    <div class="block2-pic hov-img0 ">
                                                        <a href="{{ route('supplier.profile', $seller->company->id) }}">
                                                            @if($seller->firstMedia)
                                                                <img  src="{{asset('images/companies/'.$seller->company->firstMedia->file_name)}}" alt="{{ $seller->name }}"
                                                                        style="left: 0%; border-radius: 20px;">
                                                            @else
                                                                <img   src="{{asset('images/no-image.png')}}"  alt="{{ $seller->company->name }}"
                                                                    style="left: 0%; border-radius: 20px;">
                                                            @endif
                                                        </a>
                                                    </div>

                                                    <div class="block2-txt  p-t-14">
                                                        <div class=" flex-col-l txt-center">
                                                            <a href="#"
                                                                 class="stext-105 cl3 hov-cl1 card-title-name-home-cat trans-04 js-name-b2 p-b-6  w-full">
                                                                 {{$seller->company->name}}
                                                            </a>
                                                            <span class="stext-104 cl4 txt-center w-full">
                                                                {{$seller->products_count }} | {{trans('custom.products')}}
                                                              
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        @endforeach
                                    @else

                                    <div class="error-not-found">
                                        <div class="not-found-msg">
                                            <p class="alert alert-danger">There are no results !</p>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                </div>
            </div>
            @if(!isset($ctegorySubliers))
            <div class="col-md-9 col-lg-9 p-b-80" id="myDiv">
                <div class="p-0 p-r-0-lg">

                    <div class="p-b-10 separator m-b-20">
                        <div class="flex-center bg1 p-0  b-rt-lb-20">
                            <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                                {{trans('custom.suppliers')}}
                            </h3>
                        </div>
                    </div>

                    <div class="row isotope-grid">

                        <div class="col-12 col-md-11 col-lg-11 p-b-35 isotope-item women">
                            <div class="row">
                                @if($sellers->count() > 0)
                                @foreach($sellers as $seller)
                            <div class="col-sm-6 col-md-3 col-lg-3 col-6 m-lr-10 m-lr-0-md  p-b-35 isotope-item women txt-center ">
                                <!-- Block2 -->
                                <div class="block2" style="filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                    <div class="block2-pic hov-img0 ">
                                        <a href="{{ route('supplier.profile', $seller->id) }}">
                                            @if($seller->firstMedia)
                                                <img   src="{{asset('images/companies/'.$seller->firstMedia->file_name)}}" alt="{{ $seller->name }}"
                                                        style="left: 0%; border-radius: 20px;">
                                            @else
                                                <img   src="{{asset('images/no-image.png')}}"  alt="{{ $seller->name }}"
                                                    style="left: 0%; border-radius: 20px;">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="block2-txt  p-t-14">
                                        <div class=" flex-col-l txt-center">
                                            <a href="#"
                                                 class="stext-105 cl3 hov-cl1 card-title-name-home-cat trans-04 js-name-b2 p-b-6  w-full">
                                                 {{$seller->name}}
                                            </a>
                                            <span class="stext-104 cl4 txt-center w-full">
                                                {{$seller->products_count}} | {{trans('custom.products')}}
                                                
                                            </span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            @endforeach
                              
                            </div>
                        </div>


                        <div class="col-12 col-md-11 col-lg-11 p-b-35 isotope-item women">
                            <div class="row">
                                @elseif($products->count() > 0)
                                     @foreach($products as $product)

                                <div class="col-sm-6 col-md-3 col-lg-3 col-6 m-lr-10 m-lr-0-md  p-b-35 isotope-item women txt-center ">
                                    <!-- Block2 -->
                                        <div class="block2" style="filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                            <div class="block2-pic hov-img0 ">
                                                <a href="{{ route('supplier.profile', $product->company->phone) }}">
                                                    @if($product->company->firstMedia)
                                                        <img  src="{{ asset('images/companies/'.$product->company->firstMedia->file_name) }}" alt="{{ $product->company->name }}"
                                                                style=" left: 0%; border-radius: 20px;">
                                                    @else
                                                        <img   src="{{asset('images/no-image.png')}}"   alt="{{ $product->company->name }}"
                                                            style="left: 0%;border-radius: 20px;">
                                                    @endif
                                                </a>
                                            </div>
       
                                            <div class="block2-txt  p-t-14">
                                                <div class=" flex-col-l txt-center">
                                                    <a href="{{ route('supplier.profile', $product->company->phone) }}"
                                                         class="stext-105 cl3 hov-cl1 card-title-name-home-cat trans-04 js-name-b2 p-b-6  w-full">
                                                         {{$product->company->name}}
                                                    </a>
                                                </div>
                                            </div>


                                        </div>
                                </div>
                                @endforeach
                            </div>
                        </div>


                        @elseif($company_distinct->count() > 0)
                            @foreach($company_distinct as $comp)
                                    <div class="col-sm-6 col-md-3 col-lg-3  col-6 m-lr-10 m-lr-0-md  p-b-35 isotope-item women txt-center ">
                                        <!-- Block2 -->
                                            <div class="block2" style="filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                                                <div class="block2-pic hov-img0 ">
                                                    <a href="{{ route('supplier.profile', $comp->phone) }}">
                                                        @if($comp->firstMedia)
                                                            <img src="{{ asset('images/companies/'.$comp->firstMedia->file_name) }}" alt="{{ $comp->name }}"
                                                                    style="left: 0%; border-radius: 20px;">
                                                        @else
                                                            <img src="{{asset('images/no-image.png')}}"   alt="{{ $comp->name }}"
                                                                style="left: 0%; border-radius: 20px;">
                                                        @endif
                                                    </a>
                                                </div>

                                                <div class="block2-txt  p-t-14">
                                                    <div class=" flex-col-l txt-center">
                                                        <a href="{{ route('supplier.profile', $comp->phone) }}"
                                                             class="stext-105 cl3 hov-cl1 card-title-name-home-cat trans-04 js-name-b2 p-b-6  w-full">
                                                             {{$comp->name}}
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                    </div>
                            @endforeach
                        @else
                                <div class="error-not-found">
                                    <div class="not-found-msg">
                                        <p class="alert alert-danger">There are no search results !</p>
                                    </div>
                                </div>

                        @endif
                          {!!  $sellers->appends(request()->all())  !!}
                    </div>


                </div>
            </div>
            @endif

        </div>
    </div>
</section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $('.category').click(function(){
        var cat =[];
        $('.category').each(function(){
            if($(this).is(":checked")){
                cat.push($(this).val());
            }
        });
        finalcat = cat.toString();
        // console.log(finalcat);
        $.ajax({
            type:'get',
            dataType:'html',
            url:'{{url("filterSellers")}}',
            // headers: {
            //     'X-CSRF-Token': '{{ csrf_token() }}',
            // },
            data:{
                category:cat
            },
            success:function(data){

                if(data != ''){
                    $("#updateDiv").html(data);
                    $("#myDiv").hide();
                    $("#div-filter-suppliers").removeAttr('hidden');
                }
            }
        })
    });
</script>
@stop
