@extends('layouts.website.master')
@section('title',auth('company')->user()->name)
@section('content')
<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#"> {{trans('custom.profile')}} </a>
        </p>
    </div>
</div>

<section class="bg0 p-t-5 p-b-120">
    <div class="container-fluid">

       
            <div class="row p-b-10 p-t-0">
                <div class="col-12 col-md-12 col-lg-12 m-lr-auto">
                    <div class="col-12 col-md-4 col-lg-4 m-lr-auto">
                        <div class="hov-img0 txt-center">

                            <a class="position-btn-edit btn bg-btn1-zi" href="{{route('buyer.edit.profile',$buyer->id)}}" > 
                                <i class="fas fa-pencil-alt"></i>
                             </a>
                            @if($buyer->firstMedia)
                                <img class="circle-img txt-center"  src="{{ asset('images/companies/'.$buyer->firstMedia->file_name) }}" alt="{{ $buyer->name }}"
                                style="max-width: 100%;  height: auto; width: 50% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                padding: 20px;">

                                <p class="cl2 mtext-114 p-b-20">{{$buyer->name}}</p>
                            @else
                                <img class="circle-img txt-center"  src="{{ asset('images/no-image.png') }}" alt="{{ $buyer->name }}" 
                                style="max-width: 100%;  height: auto; width: 50% !important;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: 50% 50%;
                                padding: 20px;">

                                <p class="cl11 mtext-114 p-b-20">TURKEYSUPPLIERS.ONLINE</p>
                            @endif

                        </div>                
                    </div>
                </div>
            </div>  

            <div class="p-b-10 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.bio')}}
                    </h3>
                </div>
            </div>

            <div class="row p-b-70 flex-c-m ">
                <div class="col-md-6 col-lg-6 col-12 txt-start m-t-40 bg0 p-all-20">
                    <div class="col-12 bg0 cl2 mtext-108">       
                        <p>    {{$buyer->description}} </p>
                    </div>
                </div>
            </div>  

            <div class="p-b-10 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.my_contact')}}
                    </h3>
                </div>
            </div>

            <div class="row p-b-0 flex-c-m ">
                <div class="col-md-4 col-lg-4 txt-start m-t-40 bg0   bor2 p-all-20">

                    <div class="col-12 bg-input1 cl2 m-t-20 m-b-20 mtext-108">  
                        <p> <i class="fa-solid fa-phone"></i> {{$buyer->phone}}</p>
                    </div>
                    <div class="col-12 bg-input1 cl2 mtext-108">  
                        <p> <i class="fa-solid fa-envelope"></i>  {{$buyer->email}} </p>
                    </div>
                    
                </div>
            </div>  

            <div class="p-b-10 separator">
                <div class="flex-center bg1 p-0  b-rt-lb-20">
                    <h3 class="latotext-108 cl0 p-r-l-10 p-10-40">
                        {{trans('custom.my_Fav_Products')}}
                    </h3>
                </div>
            </div>

            <div class="row p-b-0 flex-c-m ">

                @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-3 col-lg-3 col-6 p-b-35 isotope-item ">
                        <!-- Block2 -->
                        <div class="col-12 bg-s2">
                            <div class="block2">
                                {{-- <form action="{{route('fav.add')}}" method="POST">
                                    @csrf
                                    @if(auth('company')->user())
                                        <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
                                    @else
                                        <input type="hidden" name="company_id" value="{{$product->company_id}}">
                                    @endif
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button  href="#" class="btn btn-red cl0  position-btn-c">
                                        X
                                    </button>
                                </form> --}}
                                <div class="block2-pic hov-img0">
                                    @if($product->product->firstMedia)
                                         <img  src="{{ asset('images/products/' . $product->product->firstMedia->file_name) }}" alt="{{$product->product->name}}"
                                            style="  border-radius: 30px; padding: 5px 5px; right:0;">
                                    @else
                                        <img  src="{{ asset('images/no-image.png') }}" alt="" class="img-fluid w-100"
                                             style=" border-radius: 30px;padding: 5px 5px;right:0; ">
                                    @endif
                                </div>
    
                                <div class="block2-txt flex-w flex-t p-t-5">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="#" class="mtext-102 cl2 hov-cl1 trans-04 js-name-b2 p-b-5">
                                            {{$product->product->name}}
                                        </a>
    
                                        <span class="mtext-102 cl1 ">
                                            {{$code}} {{$product->product->price}}
                                        </span>
                                    </div>

                                </div>
    
                                    <a  href="{{route('product.details', ['id' => $product->product->id, 'slug' => $product->product->slug])}}"  class="btn bg1 cl0  position-btn">
                                        {{trans('custom.product_details')}}
                                    </a>
                            </div>
                        </div>

                        
                    </div>
                @endforeach
                @else
                    <div class="error-not-found">
                        <div class="not-found-msg">
                            <p class="alert alert-danger">{{trans('custom.products_not_found')}}</p>
                        </div>
                    </div>
                @endif


            </div>

            </div>  



    </div>
</section>	


@stop
