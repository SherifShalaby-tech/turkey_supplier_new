<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Categories\Store;
use App\Http\Requests\Backend\Categories\Update;
use App\Models\Category;
use App\Models\ShipmentOrderNew;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Psy\Util\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_shipment_order_news')->only(['index']);
        $this->middleware('permission:create_shipment_order_news')->only(['create', 'store']);
        $this->middleware('permission:update_shipment_order_news')->only(['edit', 'update']);
        $this->middleware('permission:delete_shipment_order_news')->only(['delete']);

    }// end of __construct
    public function index(){
        try{
            return view('Admin.shipping.index');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function data() {
        $shippings = ShipmentOrderNew::select();
        return DataTables::of($shippings)->smart(true)
            ->addIndexColumn()
            ->editColumn('created_at', function (ShipmentOrderNew $shipping) {
                return $shipping->created_at->format('Y-m-d');
            })
            ->editColumn('shipment_name', function (ShipmentOrderNew $shipping) {
                return $shipping->shipment_name == 'air_freight' ? trans('custom.air_freight'):trans('custom.sea_freight');
            })
            ->editColumn('shipment_type', function (ShipmentOrderNew $shipping) {
                return $shipping->shipment_type == 'FOB' ? trans('custom.FOB'):trans('custom.Ex-Factory');
            })
            ->editColumn('unit', function (ShipmentOrderNew $shipping) {
                if($shipping->unit == 'm'){
                  return trans('custom.m');
                }elseif($shipping->unit == 'cm'){
                    return trans('custom.cm');
                }elseif($shipping->unit == 'insh'){
                    return trans('custom.insh');
                }else{
                    return trans('custom.yard');
                }
            })
            ->editColumn('weightunit', function (ShipmentOrderNew $shipping) {
                if($shipping->weightunit == 'kg'){
                  return trans('custom.Kg');
                }elseif($shipping->weightunit == 'g'){
                    return trans('custom.g');
                }elseif($shipping->weightunit == 'pound'){
                    return trans('custom.pound');
                }else{
                    return trans('custom.ounce');
                }
            })
            ->addColumn('actions', function (ShipmentOrderNew $shipping) {
                return view('Admin.shipping.datatable.actions',compact('shipping'));
            })
            ->rawColumns(['actions'])
            ->toJson();
    }



    public function destroy(Request $request){
        try{
            ShipmentOrderNew::where('id',$request->id)->delete();
            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function showdata($id)
    {
        // dd($id);
        try {
            $shipping = ShipmentOrderNew::whereId($id)->first();
            return view('Admin.shipping.show',compact('shipping'));
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

}
