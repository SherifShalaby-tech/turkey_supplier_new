<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PoliceRequest;
use App\Models\police;
use App\Models\PolicieRule;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
class PoliceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_polices')->only(['index']);
        $this->middleware('permission:create_polices')->only(['create', 'store']);
        $this->middleware('permission:update_polices')->only(['edit', 'update']);
        $this->middleware('permission:delete_polices')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $polices = PolicieRule::latest()->paginate(10);
        return view('Admin.polices.index',compact('polices'));
    }
    public function store(policeRequest $request)
    {
        if(!empty($request->translations))
        {
            $input['translation'] = $request->translations;
        }else{
            $input['translation']=[];
        }
        $input['title'] = $request->title;
        $input['description'] = $request->description;
        $input['admin_id'] = Auth::user()->id;
        PolicieRule::create($input);
        // PolicieRule::create($request->validated());
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function update(PoliceRequest $request, PolicieRule $police)
    {
        // $request_data = $request->validated();
        if(!empty($request->translations))
        {
            $input['translation'] = $request->translations;
        }else{
            $input['translation']=[];
        }
        $input['title'] = $request->title;
        $input['description'] = $request->description;
        $input['admin_id'] = Auth::user()->id;
        $police->update($input);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(PolicieRule $police)
    {
        $police->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
