<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_ads')->only(['index']);
        $this->middleware('permission:create_ads')->only(['create', 'store']);
        $this->middleware('permission:update_ads')->only(['edit', 'update']);
        $this->middleware('permission:delete_ads')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $ads = Ad::where('start_date', '<=', Carbon::now())
        ->where('end_date', '>=', Carbon::now())
        ->latest()->paginate(10);
        return view('Admin.ads.index',compact('ads'));
    }
    public function store(AdRequest $request)
    {
        $input['title'] = $request->title;
        $input['name_entity'] = $request->name_entity;
        $input['start_date'] = $request->start_date;
        $input['end_date'] = $request->end_date;
        if ($image = $request->file('image')) {
            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
            $path = public_path('images/ads/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        Ad::create($input);
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function update(AdRequest $request, Ad $ad)
    {
        // dd($request->all());
        $input['title'] = $request->title;
        $input['name_entity'] = $request->name_entity;
        $input['start_date'] = $request->start_date;
        $input['end_date'] = $request->end_date;
        if ($image = $request->file('image')) {
            if($ad->image != null && file_exists(public_path('images/ads/' . $ad->image))){
                unlink(public_path('images/ads/' . $ad->image));
            }
            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
            $path = $path = public_path('images/ads/' . $file_name);;
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        $ad->update($input);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(Ad $ad)
    {
        if($ad->image != null && file_exists(public_path('/dashboard/app-assets/images/ads/' . $ad->image))){
            unlink('dashboard/app-assets/images/ads/' . $ad->image);
        }
        $ad->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
