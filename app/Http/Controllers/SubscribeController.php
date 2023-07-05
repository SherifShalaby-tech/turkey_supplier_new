<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubScribe;
use App\utils\helpers;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class SubscribeController extends BaseController
{

    //-------------- Get All Categories ---------------\\

    public function index(Request $request)
    {
        // How many items do you want to display.
        $perPage = $request->limit;
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        $order = $request->SortField;
        $dir = $request->SortType;
        $helpers = new helpers();

        $categories = SubScribe::where(function ($query) use ($request) {
                return $query->when($request->filled('search'), function ($query) use ($request) {
                    return $query->where('email', 'LIKE', "%{$request->search}%");
                });
            });
        $totalRows = $categories->count();
        $categories = $categories->offset($offSet)
            ->limit($perPage)
            ->orderBy($order, $dir)
            ->get();

        return response()->json([
            'categories' => $categories,
            'totalRows' => $totalRows,
        ]);
    }


    public function getSubScribe()
    {
        try{
            $subscribes = SubScribe::get();
            return view('Admin.subscribe.index',compact('subscribes'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    /*public function data() {
        $subscribes = SubScribe::get();
        return DataTables::of($subscribes)
            ->addIndexColumn()
            ->editColumn('created_at', function (SubScribe $subscribes) {
                return $subscribes->created_at->format('Y-m-d');
            })
            ->toJson();
    }*/


    //-------------- Store New Category ---------------\\

    public function store(Request $request)
    {

    }

     //------------ function show -----------\\

    public function show($id){
        //

    }

    //-------------- Update Category ---------------\\

    public function update(Request $request, $id)
    {


    }

    //-------------- Remove Category ---------------\\

    public function destroy(Request $request, $id)
    {

        SubScribe::whereId($id)->delete();
        return response()->json(['success' => true]);
    }

    //-------------- Delete by selection  ---------------\\

    public function delete_by_selection(Request $request)
    {
        $selectedIds = $request->selectedIds;

        foreach ($selectedIds as $category_id) {
            Category::whereId($category_id)->delete();
        }

        return response()->json(['success' => true]);
    }

}
