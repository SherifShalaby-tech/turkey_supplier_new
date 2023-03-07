<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\shipmentser;
use App\Models\ShipmentServices;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShipmentServiceController extends Controller
{
    public function index(){
        try{
            $shipment = ShipmentServices::latest()->get(['id','name','basic_shipping_service','translation']);
            return view('Admin.shipment_serv.index',compact('shipment'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id){
        try{
            $shipment = ShipmentServices::where('id',$id)->first();
            return view('Admin.shipment_serv.edit',compact('shipment'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function update(shipmentser $request){
        try{
            $request->validated();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            $shipment = ShipmentServices::where('id',$request->id)->first();
            if(!empty($request->translations))
            {
                $shipment->translation = $request->translations;
            }else{
                $shipment->translation=[];
            }
//            $shipment->name = $request->name;
            $shipment->basic_shipping_service = $request->basic_shipping_service;
            $shipment->save();
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
