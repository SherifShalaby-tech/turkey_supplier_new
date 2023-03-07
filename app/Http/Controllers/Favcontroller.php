<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Favcontroller extends Controller
{
    public function addFav(Request $request){
        try{
            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            if(Favorite::where('company_id',$request->company_id)
                ->where('product_id',$request->product_id)
                ->exists()){
                $favDel = Favorite::where('company_id',$request->company_id)
                    ->where('product_id',$request->product_id)
                    ->first();
                $favDel->delete();
                return redirect()->back();
            }else{
                Alert::success(trans('admins.success'), trans('admins.add-succes'));
                $favCreate = Favorite::create([
                    'company_id' => $request->company_id,
                    'product_id' => $request->product_id
                ]);
                return redirect()->back();
            }
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }
}
