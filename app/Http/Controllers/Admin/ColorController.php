<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_colors')->only(['index']);
        $this->middleware('permission:create_colors')->only(['create', 'store']);
        $this->middleware('permission:update_colors')->only(['edit', 'update']);
        $this->middleware('permission:delete_colors')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $colors = Color::latest()->paginate(10);
        return view('Admin.colors.index',compact('colors'));
    }
    public function store(ColorRequest $request)
    {
        Color::create($request->validated());
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function update(ColorRequest $request, Color $color)
    {
        $request_data = $request->validated();
        $color->update($request_data);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(Color $color)
    {
        $color->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
