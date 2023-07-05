<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Favcontroller extends Controller
{
    public function addFav(Request $request){
        try{
            $checkProduct=Favorite::where('company_id', $request->company_id)
            ->where('product_id', $request->product_id)->first();
        if ($checkProduct!==null) {
             $favDel = Favorite::where('company_id', $request->company_id)
            ->where('product_id', $request->product_id)
            ->forceDelete();
            return response()->json(['data' => 0]);
        } else {

                $favCreate = Favorite::create([
                    'company_id' => $request->company_id,
                    'product_id' => $request->product_id
                ]);
                return response()->json(['data' => 1]);
            }
        }catch (\Exception $exception){
            return response()->json(['data' => $exception->getMessage()]);
        }
    }

    public function removeFav(Request $request){
        try{
            Alert::success('success',trans('admins.delete-succes'));
            if(Favorite::where('company_id',$request->user_id)
                ->where('product_id',$request->product_id)
                ->exists()){
                $favDel = Favorite::where('company_id',$request->user_id)
                    ->where('product_id',$request->product_id)
                    ->first();
                $favDel->forceDelete();
                return redirect()->back();
            }else{
                Alert::error('error msg',"Not exist");
                return redirect()->back();
            }
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
