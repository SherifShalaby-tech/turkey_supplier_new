@extends('layouts.website.master')
@section('title','Cart')
@section('content')

<div class="bg0 p-t-10 p-b-20">
    <div class="container-fluid">
        <p class="cl6">
            <a  class="cl6" href="{{route('website.index')}}"> <i class="fas fa-home"></i> </a>
            /
            <a  class="cl6" href="#">{{trans('custom.cart')}} </a>
        </p>
    </div>
</div>



<form class="bg0 p-t-75 p-b-85" action="{{route('cart.confirm.cart')}}" method="POST">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-11 col-xl-11 m-lr-auto m-b-50">
                <div class=" m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-4">Quantity</th>
                                <th class="column-4">color</th>
                                <th class="column-4" hidden>test</th>
                                <th class="column-5">size</th>
                                <th class="column-5">Price</th>
                                <th class="column-5">Total Price</th>
                                <th class="column-5">action</th>
                            </tr>

                            @if(isset($details))
                            @foreach($details as $key => $de)
                                    <!-- hidden inputs -->
                                    <input type="hidden" name="cart_id" value="{{$de->cart_id}}">
                                    <input type="hidden" name="user_id" value="{{$cart->company_id}}">
                                    <input type="hidden" class="product" id="product_id" name="products[{{$key}}][product_id]" value="{{$de->product->id}}">
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="@if(app()->getLocale() == 'ar') block3-pic @else block2-pic @endif ">
                                            @if($de->product->firstMedia)
                                             <img class="p-tb-5 p-lr-5  p-lr-0-md height-r-h" src="{{ asset('images/products/'.$de->product->firstMedia->file_name) }}" alt="{{ $de->product->name }}"
                                             style="max-width: 100%;  height: 225px; width: 100% !important;
                                                                background-size: cover;
                                                                background-repeat: no-repeat;
                                                                background-position: 50% 50%;
                                                                border-radius: 30px;">
                                            @else
                                             <img class="circle-img" src="{{ asset('images/no-image.png') }}" alt="{{ $de->product->name }}"
                                                    style="width: 100%; height: 140px;">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="column-2" style="padding-left: 20px">{{$de->product->name}}</td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" id="qty" id-item="item-{{$de->product->id}}" type="number" value="1" name="products[{{$key}}][qty]">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-4 lead" hidden id="lead-item-{{$de->product->id}}" p-value="{{$de->product->price}}">
                                            @foreach ($de->product->leadtimes as $leadtime)
                                                    <div>
                                                        <p class="lead_qty">{{$leadtime->qty}}</p>
                                                        <p class="lead_price">{{$leadtime->price}}</p>
                                                    </div>
                                                    
                                            @endforeach
                                        
                                    </td>
                                    <td class="column-4 ">{{$de->product->color}} </td>
                                    <td class="column-5">{{$de->product->size}}</td>
                                    <td class="column-5 cl11 price" id="main_price">
                                        {{$code}}
                                        {{$de->product->price}}
                                    </td>
                                    <td class="column-5 cl11 total_price" >{{$code}} {{$de->product->price}}</td>
                                    <td class="column-5">
                                        <a class=" mtext-105 cl0 bg1 p-lr-10 p-tb-10" href="{{route('cart.product.delete',[$de->product->id,$de->cart_id])}}">
                                            <i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <div class="add-address">
                                    <p>{{trans('custom.Your_Cart_is_empty')}}</p>
                                    <a href="{{route('website.index')}}">{{trans('custom.Continue_shopping')}}</a>
                                </div>
                            @endif
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-sm-12 col-lg-4 col-xl-4 m-lr-auto m-b-50">
                <div class="  p-lr-10 p-t-20 p-b-20 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    {{-- <div class="flex-t mtext-105 cl1">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="flex-c-m  p-t-5 p-b-20  box-shadow-0-10-10 bor-r10  ">
                        <div class="size-209  p-r-0-sm w-full-ssm txt-center p-tb-20">
 
                            <p class="mtext-105 cl6 p-t-2">
                                {{trans('custom.Your_order_qualifies_for_FREE_Shipping_Choose_this_option_at_checkout')}}.
                            </p>
                            <p class="cl11 mtext-105">
                                {{trans('custom.see_details')}}
                            </p>

                        </div>
                    </div> --}}
                    <div class="flex-c-m  p-t-5 p-b-20  ">
                        <button class="flex-c-m mtext-102 cl0  bg1 size-116  p-lr-15 trans-04 pointer m-t-20 bor-r10">
                            {{trans('custom.Proceed_to_Buy')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input hidden value="{{ $code ?? '' }}" class="code">
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
        var row = $(this).closest('tr');
        chnageQyt(row);
    });
    
   
    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
        var row = $(this).closest('tr');
        chnageQyt(row);
    });
    $('.num-product').on('change', function(){
        var row = $(this).closest('tr');
        chnageQyt(row);
       
    });


    function chnageQyt(row){
        
        var elm_q=row.find('.num-product');
        var id_item =elm_q .attr('id-item');
        var elm_rows=$('#lead-'+ id_item +' > div');

        var qty = Number(row.find('.num-product').val());

        var main_price =$('#lead-'+ id_item ).attr('p-value');
        var price = row.find('.price').text().replace(/[^0-9\.]+/g, "");
        var new_price = main_price;
        elm_rows.each((ele,tr)=>{

            var leadQty = parseInt($(tr).find('.lead_qty').text());
            var leadPrice = parseFloat( $(tr).find('.lead_price').text());  
            if(leadQty <= qty){
                new_price = leadPrice;
               
            }


        })
        var code = $('.code').val();
        var totalPrice = (qty * new_price).toFixed(2);
        row.find('.total_price').text(code + totalPrice);
        row.find('.price').text(code + new_price);
        
    }
</script>  
@stop
