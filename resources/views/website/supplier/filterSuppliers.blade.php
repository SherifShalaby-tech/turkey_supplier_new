@if(isset($ctegorySubliers))
    @if($ctegorySubliers->count() > 0)
        @foreach($ctegorySubliers as $seller)
            <div class="col-sm-6 col-md-3 col-lg-3  col-6 m-lr-10 m-lr-0-md  p-b-35 isotope-item women txt-center ">
                <!-- Block2 -->
                <div class="block2" style="filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
                    <div class="block2-pic hov-img0 ">
                        <a href="{{ route('supplier.profile', $seller->company->id) }}">
                            @if($seller->company->firstMedia)
                                <img src="{{asset('images/companies/'.$seller->company->firstMedia->file_name)}}" alt="{{ $seller->name }}"
                                        style="left: 0%; border-radius: 20px;">
                            @else
                                <img src="{{asset('images/no-image.png')}}"  alt="{{ $seller->company->name }}" 
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
                                @if($seller->company->products->count() > 0)

                                {{$seller->company->products->count()}} | {{trans('custom.products')}}
                                @else
                                   0 | {{trans('custom.products')}}
                                @endif
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