<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HelpcentreRequest;
use App\Models\HelpCenter;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
class HelpcenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_helpcenters')->only(['index']);
        $this->middleware('permission:create_helpcenters')->only(['create', 'store']);
        $this->middleware('permission:update_helpcenters')->only(['edit', 'update']);
        $this->middleware('permission:delete_helpcenters')->only(['delete']);

    }// end of __construct
    public function index()
    {

        $helpcenters = HelpCenter::latest()->paginate(10);
        return view('Admin.helpcentres.index',compact('helpcenters'));
    }
    public function store(HelpcentreRequest $request)
    {
        if(!empty($request->translations))
        {
            $input['translation'] = $request->translations;
        }else{
            $input['translation']=[];
        }
        if ($image = $request->file('image')) {
            $file_name = time() . "." . $image->getClientOriginalExtension();
            $path = public_path('/images/helpcenter/' . $file_name);
            Image::make($image->getRealPath())->save($path);
            $input['image'] = $file_name;
        }
        $input['title'] = $request->title;
        $input['description'] = $request->description;
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        HelpCenter::create($input);
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function update(HelpcentreRequest $request, HelpCenter $helpcenter)
    {
        // $request_data = $request->validated();
        if(!empty($request->translations))
        {
            $input['translation'] = $request->translations;
        }else{
            $input['translation']=[];
        }
        if ($image = $request->file('image')) {
            if($helpcenter->image != null && file_exists(public_path('/images/helpcenter/' . $helpcenter->image))){
                unlink('images/helpcenter/' . $helpcenter->image);
            }
            $file_name = time().".".$image->getClientOriginalExtension();
            $path = public_path('/images/helpcenter/' . $file_name);
            Image::make($image->getRealPath())->save($path);
            $input['image'] = $file_name;
        }
        $input['title'] = $request->title;
        $input['description'] = $request->description;
        $input['admin_id'] = Auth::user()->id;
        $helpcenter->update($input);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(HelpCenter $helpcenter)
    {
        if($helpcenter->image != null && file_exists(public_path('/images/helpcenter/' . $helpcenter->image))){
            unlink('images/helpcenter/' . $helpcenter->image);
        }
        $helpcenter->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
