<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Models\Size;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_sizes')->only(['index']);
        $this->middleware('permission:create_sizes')->only(['create', 'store']);
        $this->middleware('permission:update_sizes')->only(['edit', 'update']);
        $this->middleware('permission:delete_sizes')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $sizes = Size::latest()->paginate(10);
        return view('Admin.sizes.index',compact('sizes'));
    }
    public function store(SizeRequest $request)
    {
        Size::create($request->validated());
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function update(SizeRequest $request, Size $size)
    {
        $request_data = $request->validated();
        $size->update($request_data);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(Size $size)
    {
        $size->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
