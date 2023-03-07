<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadtimeRequest;
use App\Models\Leadtime;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
class LeadtimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_leadtimes')->only(['index']);
        $this->middleware('permission:create_leadtimes')->only(['create', 'store']);
        $this->middleware('permission:update_leadtimes')->only(['edit', 'update']);
        $this->middleware('permission:delete_leadtimes')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $leadtimes = Leadtime::latest()->paginate(10);
        return view('Admin.leadtimes.index',compact('leadtimes'));
    }
    public function store(LeadtimeRequest $request)
    {
        Leadtime::create($request->validated());
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function update(LeadtimeRequest $request, Leadtime $leadtime)
    {
        $request_data = $request->validated();
        $leadtime->update($request_data);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(Leadtime $leadtime)
    {
        $leadtime->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
