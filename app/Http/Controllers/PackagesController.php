<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\utils\helpers;

class PackagesController extends BaseController
{

    //-------------- show All Packages -----------\\

    public function index(Request $request)
    {
        $this->authorizeForUser($request->user('api'), 'view', Package::class);
        $perPage = $request->limit;
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        $order = $request->SortField;
        $dir = $request->SortType;
        $helpers = new helpers();

        $Packages = Package::where('deleted_at', '=', null)

        // Search With Multiple Param
            ->where(function ($query) use ($request) {
                return $query->when($request->filled('search'), function ($query) use ($request) {
                    return $query->where('name', 'LIKE', "%{$request->search}%");
                });
            });
        $totalRows = $Packages->count();
        $Packages = $Packages->offset($offSet)
            ->limit($perPage)
            ->orderBy($order, $dir)
            ->get();

            foreach ($Packages as $package) {
                $unit_data['id'] = $package->id;
                $unit_data['name'] = $package->name;
                $unit_data['status'] = $package->status == "1" ? "Active": "DeActive";
                $unit_data['products_count'] = $package->products_count;
                $data[] = $unit_data;
            }

        return response()->json([
            'Packages' => $data,
            'totalRows' => $totalRows,
        ]);

    }

    //-------------- STORE NEW Package -----------\\

    public function store(Request $request)
    {
        $this->authorizeForUser($request->user('api'), 'create', Package::class);

        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'products_count' => 'required',
        ]);



        Package::create([
            'name' => $request['name'],
            'status' => $request['status'],
            'products_count' => $request['products_count'],
        ]);

        return response()->json(['success' => true]);

    }

    //-------------- UPDATE Package -----------\\

    public function update(Request $request, $id)
    {
        $this->authorizeForUser($request->user('api'), 'update', Package::class);

        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'products_count' => 'required',
        ]);



        Package::whereId($id)->update([
            'name' => $request['name'],
            'status' => $request['status'],
            'products_count' => $request['products_count'],
        ]);

        return response()->json(['success' => true]);

    }

    //-------------- REMOVE Package -----------\\

    public function destroy(Request $request, $id)
    {
        $this->authorizeForUser($request->user('api'), 'delete', Package::class);


            Package::whereId($id)->update([
                'deleted_at' => Carbon::now(),
            ]);

            return response()->json(['success' => true]);


    }



}
