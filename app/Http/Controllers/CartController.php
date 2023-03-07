<?php

namespace App\Http\Controllers;

use App\Http\Requests\Website\Orders\addOrder;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function addProduct (Request $request){
        try{
            if($cart = Cart::where('company_id',$request->user_id)->where('status',0)->exists()){
                $cart = Cart::where('company_id',$request->user_id)->where('status',0)->first();
                if(CartDetails::where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('status',0)->exists()){
                    Alert::warning('warning message',trans('custom.This_product_already_exists'));
                    return redirect()->back();
                }else{
                    Alert::success('success message',trans('custom.The_product_has_been_updated_and_added_to_the_cart'));

                    $detailsUpdate = CartDetails::create([
                        'cart_id' => $cart->id,
                        'product_id' => $request->product_id
                    ]);
                    return redirect()->back();
                }
            }else{

                Alert::success('success message',trans('custom.The_product_has_been_added_to_the_cart'));

                $cartCreate = Cart::create([
                    'company_id' => $request->user_id,
                ]);
                $detailsCreate = CartDetails::create([
                    'cart_id' => $cartCreate['id'],
                    'product_id' => $request->product_id
                ]);
                return redirect()->back();
            }
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function getCartPage(Request $request){
        $cart = Cart::where('company_id',auth('company')->user()->id)
            ->where('status',0)
            ->first();
        if($cart){
            $details = CartDetails::where('cart_id',$cart->id)->where('status',0)->get();
            return view('website.cart.index',compact('cart','details'));
        }
        return view('website.cart.index',compact('cart'));
    }

    public function deleteProductFromCart($product_id,$cart_id){
        try{

            Alert::success('success message',trans('custom.The_product_has_been_removed_from_the_cart'));

            $product = CartDetails::where('cart_id',$cart_id)->where('product_id',$product_id)->first();
            if($product){
                $cart = Cart::where('id',$cart_id)->first();
                if($cart->details->count() == 1){
                    $product->delete();
                    $cart->status = 1;
                    $cart->save();
                    return redirect()->back();
                }else{
                    $product->delete();
                    return redirect()->back();
                }
            }
        }catch (\Exception $exception){
            Alert::error('error message',$exception->getMessage());
        }
    }

    public function saveProduct(Request $request){
        try{

            Alert::success('success msg',trans('custom.The_request_has_been_saved'));

            $product = CartDetails::where('cart_id',$request->cart_id)->where('product_id',$request->product_id)->first();
            if($product->product_save != null){
                Alert::warning('msg','The product has already been saved');
                return redirect()->back();
            }else{
                $product->product_save = 1;
                $product->save();
                return redirect()->back();
            }
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function confirmCart(addOrder $request){
        try{
            if($request->products){
                foreach ($request->products as $product){
                    $productt = Product::where('id',$product['product_id'])->first();
                    $product_price = $productt->price;
                    $cartDetails = CartDetails::where('cart_id',$request->cart_id)
                        ->where('product_id',$product['product_id'])
                        ->first();
                    $cartDetails->qty = $product['qty'];
                    $cartDetails->total_price = $product_price * $product['qty'];
                    $cartDetails->save();
                  //  dd('done');
                }
            }
            $orderCreate = Sale::create([
                'company_id' => $request->user_id,
                'total_price' => 0,
                'status' => 'processing',
                'payment_statut' => 'unpaid',
                'order_number' => rand(),
            ]);
            // convert cart status == true
            $cart = Cart::where('id',$request->cart_id)->first();
            $cart->status =  1;
            $cart->save();
            // create order details
            $orderDetails = SaleDetail::create([
                'sale_id' => $orderCreate['id'],
                'cart_id' => $cart->id
            ]);
            //calc totalPrice
            $cartDetails = CartDetails::where('cart_id',$cart->id)->get();
            foreach ($cartDetails as $index => $details) {
                $details->status = 1;
                $details->save();
                $orderTotalPrice = $details->where('cart_id', $cart->id)->sum('total_price');
                $order = Sale::where('id', $orderCreate['id'])->first();
                $order->total_price = $orderTotalPrice;
                $order->save();

                Alert::success('success message',trans('custom.The_request_has_been_sent_successfully'));

                return redirect(route('order.payment',$order->id));
            }
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function get_a_sample(Request $request){
        try{
            DB::beginTransaction();
            if($cart = Cart::where('company_id',$request->user_id)->where('status',0)->exists()){
                $cart = Cart::where('company_id',$request->user_id)->where('status',0)->first();
                if(CartDetails::where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('status',0)->exists()){

                    Alert::warning('warning message',trans('custom.This_product_already_exists'));
                    return redirect()->back();
                }else{
                    Alert::success('success message',trans('custom.The_product_has_been_updated_and_added_to_the_cart'));

                    $detailsUpdate = CartDetails::create([
                        'cart_id' => $cart->id,
                        'product_id' => $request->product_id
                    ]);
                    return redirect()->back();
                }
            }else{

                Alert::success('success message',trans('custom.The_product_has_been_added_to_the_cart'));

                $cartCreate = Cart::create([
                    'company_id' => $request->user_id,
                ]);
                $detailsCreate = CartDetails::create([
                    'cart_id' => $cartCreate['id'],
                    'product_id' => $request->product_id,

                    // 'qty' => 1,
                    // 'total_price' => $request->product_price
                ]);
                // create order
                // $order_create = Sale::create([
                //    'company_id' => $request->user_id,
                //    'total_price' => $detailsCreate['total_price'],
                //     'payment_statut' => 'unpaid',
                //     'status' => 'processing',
                //     'order_number' => rand()
                // ]);
                // // order details
                // $order_details = SaleDetail::create([
                //     'sale_id' => $order_create['id'],
                //     'cart_id' => $detailsCreate['cart_id']
                // ]);
                // $cart = Cart::where('id',$cartCreate['id'])->update(['status' => 1]);
                // $cart_det = CartDetails::where('id',$detailsCreate['id'])->update(['status' => 1]);
                DB::commit();
                return redirect()->back();

            }
        }catch (\Exception $exception){
            Alert::error("error msg",$exception->getMessage());
            return redirect()->back();
        }
    }
}
