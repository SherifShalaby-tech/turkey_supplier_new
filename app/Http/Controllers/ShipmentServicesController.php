<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Brand;
use App\Models\ShipmentServices;
use App\utils\helpers;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ShipmentServicesController extends Controller
{

    //------------ GET ALL Brands -----------\\

    public function index(Request $request)
    {
        //$this->authorizeForUser($request->user('api'), 'view', Brand::class);
        // How many items do you want to display.
        $perPage = $request->limit;
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        $order = $request->SortField;
        $dir = $request->SortType;
        $helpers = new helpers();

        $shipment_services = ShipmentServices::where('deleted_at', '=', null)

        // Search With Multiple Param
            ->where(function ($query) use ($request) {
                return $query->when($request->filled('search'), function ($query) use ($request) {
                    return $query->where('name', 'LIKE', "%{$request->search}%");
                });
            });
        $totalRows = $shipment_services->count();
        $shipment_services = $shipment_services->offset($offSet)
            ->limit($perPage)
            ->orderBy($order, $dir)
            ->get();

        return response()->json([
            'shipment_services' => $shipment_services,
            'totalRows' => $totalRows,
        ]);

    }

    //---------------- STORE NEW Brand -------------\\

    public function store(Request $request)
    {
        $this->authorizeForUser($request->user('api'), 'create', Brand::class);

        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'basic_shipping_service' => 'required',
            'image' => 'required',
        ]);

        \DB::transaction(function () use ($request) {

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $filename = rand(11111111, 99999999) . $image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200, 200);
                $image_resize->save(public_path('/images/shipment_services/' . $filename));

            } else {
                $filename = 'no-image.png';
            }

            $ShipmentServices = new ShipmentServices;

            $ShipmentServices->name = $request['name'];
            $ShipmentServices->detail = $request['detail'];
            $ShipmentServices->basic_shipping_service = $request['basic_shipping_service'];
            $ShipmentServices->image = $filename;
            $ShipmentServices->save();

        }, 10);

        return response()->json(['success' => true]);

    }

     //------------ function show -----------\\

     public function show($id){
        //

    }

     //---------------- UPDATE Brand -------------\\

     public function update(Request $request, $id)
     {

        // $this->authorizeForUser($request->user('api'), 'update', Brand::class);

         request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'basic_shipping_service' => 'required',
            'image' => 'required',
         ]);
         \DB::transaction(function () use ($request, $id) {
             $Ads = ShipmentServices::findOrFail($id);
             $currentImage = $Ads->image;

             if ($currentImage && $request->image != $currentImage) {
                 $image = $request->file('image');
                 $path = public_path() . '/images/shipment_services';
                 $filename = rand(11111111, 99999999) . $image->getClientOriginalName();

                 $image_resize = Image::make($image->getRealPath());
                 $image_resize->resize(200, 200);
                 $image_resize->save(public_path('/images/shipment_services/' . $filename));

                 $AdsImage = $path . '/' . $currentImage;
                 if (file_exists($AdsImage)) {
                     if ($currentImage != 'no-image.png') {
                         @unlink($AdsImage);
                     }
                 }
             } else if (!$currentImage && $request->image !='null'){
                 $image = $request->file('image');
                 $path = public_path() . '/images/shipment_services';
                 $filename = rand(11111111, 99999999) . $image->getClientOriginalName();

                 $image_resize = Image::make($image->getRealPath());
                 $image_resize->resize(200, 200);
                 $image_resize->save(public_path('/images/shipment_services/' . $filename));
             }

             else {
                 $filename = $currentImage?$currentImage:'no-image.png';
             }

             ShipmentServices::whereId($id)->update([
                 'name' => $request['name'],
                 'detail' => $request['detail'],
                 'basic_shipping_service' => $request['basic_shipping_service'],
                 'image' => $filename,
             ]);

         }, 10);

         return response()->json(['success' => true]);
     }

    //------------ Delete Brand -----------\\

    public function destroy(Request $request, $id)
    {
        //$this->authorizeForUser($request->user('api'), 'delete', Brand::class);

        ShipmentServices::whereId($id)->update([
            'deleted_at' => Carbon::now(),
        ]);
        return response()->json(['success' => true]);
    }

    //-------------- Delete by selection  ---------------\\

    public function delete_by_selection(Request $request)
    {

      //  $this->authorizeForUser($request->user('api'), 'delete', Brand::class);

        $selectedIds = $request->selectedIds;
        foreach ($selectedIds as $brand_id) {
            ShipmentServices::whereId($brand_id)->update([
                'deleted_at' => Carbon::now(),
            ]);
        }
        return response()->json(['success' => true]);

    }

}
