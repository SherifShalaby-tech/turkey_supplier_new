@foreach($subcategories as $category)
<div class="col-sm-6 col-md-3 col-lg-3 col-6 m-lr-11  p-b-35 isotope-item women txt-center ">
    <!-- Block2 -->
    <div class="block2" style="filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));">
        <div class="block2-pic hov-img0 ">
            <a href="{{route('subcategory.products',$category->id)}}">
                @if($category->image)
                    <img src="{{asset('images/sub_categories/' . $category->image)}}"
                            style="left: 0%;border-radius: 20px;">
                @else
                    <img src="{{asset('images/no-image.png')}}"  
                        style="left: 0%; border-radius: 20px;">
                @endif
            </a>
        </div>
        <div class="block2-txt  p-t-7">
            <div class=" flex-col-l txt-center">
                <a href="{{route('category.products',$category->id)}}"
                    class="stext-105 cl3 hov-cl1 trans-04 js-name-b2 p-b-6 card-title-name-home-cat  w-full">
                    {{$category->name}}
                </a>

                <span class="stext-104 cl4 txt-center w-full">
                    {{$category->products->count()}} | {{trans('custom.products')}}
                </span>
            </div>
        </div>

        
    </div>
</div>
@endforeach