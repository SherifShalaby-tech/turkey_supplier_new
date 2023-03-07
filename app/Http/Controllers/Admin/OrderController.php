<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_orders')->only(['index']);
        $this->middleware('permission:create_orders')->only(['create', 'store']);
        $this->middleware('permission:update_orders')->only(['edit', 'update']);
        $this->middleware('permission:delete_orders')->only(['delete']);

    }// end of __construct
    public function index(){
        try{
            return view('Admin.orders.index');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function data() {
        $sales = Sale::select();
        return DataTables::of($sales)
            ->addIndexColumn()
            ->editColumn('created_at', function (Sale $order) {
                return $order->created_at->format('Y-m-d');
            })
            ->editColumn('company_id', function (Sale $order) {
                return $order->user->name;
            })
            // ->editColumn('image',function (Product $product){
            //     $html = '<img width="100" src="'.asset('images/products/' . $product->image[0]).'">';
            //     return $html;
            // })
            ->addColumn('actions', function (Sale $order) {
                return view('Admin.orders.datatable.actions',compact('order'));
            })
            ->rawColumns(['actions','company_id'])
            ->toJson();
    }

    public function details($id){
        try{
           $details = SaleDetail::where('sale_id',$id)->get(['id','sale_id','cart_id']);
            return view('Admin.orders.details',compact('details'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        try{
            toast('deleted success','success');
            $order = Sale::where('id',$request->id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
