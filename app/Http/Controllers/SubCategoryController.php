<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategories;
use App\utils\helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends BaseController
{

    //-------------- Get All Categories ---------------\\

    public function index(Request $request)
    {
        $this->authorizeForUser($request->user('api'), 'view', Category::class);
        // How many items do you want to display.
        $perPage = $request->limit;
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        $order = $request->SortField;
        $dir = $request->SortType;
        $helpers = new helpers();

        $subcategories = SubCategories::with('category')

        // Search With Multiple Param
            ->where(function ($query) use ($request) {
                return $query->when($request->filled('search'), function ($query) use ($request) {
                    return $query->where('name', 'LIKE', "%{$request->search}%");
                });
            });
        $totalRows = $subcategories->count();
        $subcategories = $subcategories->offset($offSet)
            ->limit($perPage)
            ->orderBy($order, $dir)
            ->get();

            $categories = Category::where('deleted_at',NULL)->get();

        return response()->json([
            'subcategories' => $subcategories,
            'totalRows' => $totalRows,
            'categories' => $categories
        ]);
    }

    //-------------- Store New Category ---------------\\

    public function store(Request $request)
    {
        $this->authorizeForUser($request->user('api'), 'create', Category::class);

        request()->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        SubCategories::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
        ]);
        return response()->json(['success' => true]);
    }

     //------------ function show -----------\\

    public function show($id){
        //

    }

    //-------------- Update Category ---------------\\

    public function update(Request $request, $id)
    {
        $this->authorizeForUser($request->user('api'), 'update', Category::class);

        request()->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        SubCategories::whereId($id)->update([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
        ]);
        return response()->json(['success' => true]);

    }

    //-------------- Remove Category ---------------\\

    public function destroy(Request $request, $id)
    {
        $this->authorizeForUser($request->user('api'), 'delete', Category::class);

        SubCategories::whereId($id)->delete();
        return response()->json(['success' => true]);
    }

    //-------------- Delete by selection  ---------------\\

    public function delete_by_selection(Request $request)
    {
        $this->authorizeForUser($request->user('api'), 'delete', Category::class);
        $selectedIds = $request->selectedIds;

        foreach ($selectedIds as $category_id) {
            SubCategories::whereId($category_id)->delete();
        }

        return response()->json(['success' => true]);
    }

}
