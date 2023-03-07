<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediationRequest;
use App\Models\Mediation;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class MediationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:read_mediations')->only(['index']);
    //     $this->middleware('permission:create_mediations')->only(['create', 'store']);
    //     $this->middleware('permission:update_mediations')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_mediations')->only(['delete']);

    // }// end of __construct
    public function index()
    {
        $mediations = Mediation::latest()->paginate(10);
        return view('Admin.mediations.index',compact('mediations'));
    }
    public function store(MediationRequest $request)
    {
        if(!empty($request->translations))
        {
            $input['translation'] = $request->translations;
        }else{
            $input['translation']=[];
        }
        $input['title'] = $request->title;
        if ($image = $request->file('image')) {
            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
            $path = public_path('images/mediations/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        $input['admin_add'] = Auth::user()->name;
        $input['description'] = $request->description;
        $input['created_at'] = now();
        $input['updated_at'] = now();
        mediation::create($input);
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function edit($id){
        $mediation = Mediation::where('id',$id)->first();
        return view('Admin.mediations.btn.edit',compact('mediation'));
    }

    public function update(MediationRequest $request, Mediation $mediation)
    {
        if(!empty($request->translations))
        {
            $input['translation'] = $request->translations;
        }else{
            $input['translation']=[];
        }
        $input['title'] = $request->title;
        $input['admin_edit'] = Auth::user()->name;
        $input['description'] = $request->description;
        if ($image = $request->file('image')) {
            if($mediation->image != null && file_exists(public_path('images/mediations/' . $mediation->image))){
                unlink(public_path('images/mediations/' . $mediation->image));
            }
            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
            $path = $path = public_path('images/mediations/' . $file_name);;
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        $mediation->update($input);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(Mediation $mediation)
    {
        if($mediation->image != null && file_exists(public_path('/images/mediations/' . $mediation->image))){
            unlink('images/mediations/' . $mediation->image);
        }
        $mediation->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
