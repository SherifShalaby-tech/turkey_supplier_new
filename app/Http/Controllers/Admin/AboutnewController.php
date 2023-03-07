<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutnewRequest;
use App\Http\Requests\ColorRequest;
use App\Models\Aboutnew;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AboutnewController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_about_us')->only(['index']);
        $this->middleware('permission:create_about_us')->only(['create', 'store']);
        $this->middleware('permission:update_about_us')->only(['edit', 'update']);
        $this->middleware('permission:delete_about_us')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $aboutnews = Aboutnew::latest()->paginate(10);
        return view('Admin.aboutnews.index', compact('aboutnews'));
    }
    public function create()
    {
        return view('Admin.aboutnews.create');
    }
    public function store(AboutnewRequest $request)
    {
        DB::beginTransaction();
        try {
            $aboutnew = new Aboutnew();
            if (!empty($request->translations)) {
                $aboutnew->translation = $request->translations;
            } else {
                $aboutnew->translation = [];
            }
            if ($image = $request->file('image')) {
                $file_name = time() . "." . $image->getClientOriginalExtension();
                $path = public_path('/images/about_us/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $aboutnew->image = $file_name;
            }
            $aboutnew->subject = $request->subject;
            $aboutnew->status = $request->status;
            $aboutnew->admin_add = Auth::user()->name;
            $aboutnew->save();
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect()->route('admin.aboutnews.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
            //    return redirect()->back()->withErrors(['Error' => $exception->getMessage()]);
        }
    }
    public function edit($id)
    {
        $aboutnew=Aboutnew::find($id);
        return view('Admin.aboutnews.edit', compact('aboutnew'));
    }
    public function update(AboutnewRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->validated();
            $aboutnew=Aboutnew::where('id', $request->id)->first();
            if (!empty($request->translations)) {
                $aboutnew->translation = $request->translations;
            } else {
                $aboutnew->translation = [];

            }
            if ($image = $request->file('image')) {
                if($aboutnew->image != null && file_exists(public_path('/images/about_us/' . $aboutnew->image))){
                    unlink('images/about_us/' . $aboutnew->image);
                }
                $file_name = time().".".$image->getClientOriginalExtension();
                $path = public_path('/images/about_us/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $aboutnew->image = $file_name;
            }
            $aboutnew->subject = $request->subject;
            $aboutnew->status = $request->status;
            $aboutnew->admin_edit = Auth::user()->name;
            $aboutnew->save();
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            return redirect()->route('admin.aboutnews.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }

    }

    public function destroy( $id)
    {
        $aboutnew = Aboutnew::find($id);
        if($aboutnew->image != null && file_exists(public_path('/images/about_us/' . $aboutnew->image))){
            unlink('images/about_us/' . $aboutnew->image);
        }
        $aboutnew->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
