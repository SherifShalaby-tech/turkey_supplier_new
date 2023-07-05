<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\Store;
use App\Http\Requests\Backend\Services\Update;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index(){
        try{
            return view('Admin.services.index');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function data() {
        $services = Service::select();
        return DataTables::of($services)
            ->addIndexColumn()
            ->editColumn('created_at', function (Service $service) {
                return $service->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function (Service $service) {
                return view('Admin.services.datatable.actions',compact('service'));
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function create(){
        return view('Admin.services.create');
    }

    public function store(Store $request){
        DB::beginTransaction();
        try{
            $request->validated();
            $service = new Service();
            // if($request->images){
            //     foreach ($request->images as $image){
            //         $ext = '.'.$image->getClientOriginalExtension();
            //         $file_name = str_replace($ext, date('d-m-Y-H-i') . $ext, $image->getClientOriginalName());
            //         $imageResize = Image::make($image->getRealPath());
            //         $file_name = $image->getClientOriginalName();
            //         $imageResize->resize(200, 200, function ($constraint) {
            //             $constraint->aspectRatio();
            //         })->save(public_path('images/services/' . $file_name));
            //         $service->images = [$file_name];
            //     }
            // }
            if(!empty($request->translations))
            {
                $service->translation = $request->translations;
            }else{
                $service->translation=[];
            }
            $service->name = $request->name;
            $service->description = $request->description;
            $service->video_link = $request->video_link;
            $service->admin_id = auth('admin')->user()->id;
            $service->save();
            if ($request->images && count($request->images) > 0) {
                $i = 1;
                foreach ($request->images as $image) {
                    $file_name = Str::slug($request->name ) . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('images/services/' . $file_name);
                    Image::make($image->getRealPath())->save($path);
                    $service->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect(route('admin.services.index'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id){
        try{
            $service = Service::where('id',$id)->first();
            return view('Admin.services.edit',compact('service'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function update(Update $request){
        DB::beginTransaction();
        try{
            $request->validated();
            $service = Service::where('id',$request->id)->first();
            // if($request->images){
            //     foreach ($request->images as $image){
            //         $ext = '.'.$image->getClientOriginalExtension();
            //         $file_name = str_replace($ext, date('d-m-Y-H-i') . $ext, $image->getClientOriginalName());
            //         $imageResize = Image::make($image->getRealPath());
            //         $file_name = $image->getClientOriginalName();
            //         $imageResize->resize(200, 200, function ($constraint) {
            //             $constraint->aspectRatio();
            //         })->save(public_path('images/services/' . $file_name));
            //         $service->images = [$file_name];
            //     }
            // }
            if(!empty($request->translations))
            {
                $service->translation = $request->translations;
            }else{
                $service->translation=[];
            }
            $service->name = $request->name;
            $service->description = $request->description;
            $service->video_link = $request->video_link;
            $service->admin_id = auth('admin')->user()->id;
            $service->save();
            if ($request->images && count($request->images) > 0) {
                $i = $service->media()->count() + 1;
                foreach ($request->images as $image) {
                    $file_name = Str::slug($service->name ) . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('images/services/' . $file_name);
                    Image::make($image->getRealPath())->save($path);
                    $service->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            return redirect(route('admin.services.index'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        try{
            $service = Service::where('id',$request->id)->first();
            if ($service->media()->count() > 0) {
                foreach ($service->media as $media) {
                    if (File::exists(public_path('images/services/' . $media->file_name))) {
                        unlink('images/services/' . $media->file_name);
                    }
                    $media->delete();
                }
            }
            $service->delete();
            Alert::success(trans('admins.success'), trans('admins.delete-succes'));
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function remove_image(Request $request)
    {
        $service = Service::findOrFail($request->service_id);
        $image = $service->media()->whereId($request->image_id)->first();
        if (File::exists('images/services/' . $image->file_name)) {
            unlink('images/services/' . $image->file_name);
        }
        $image->delete();
        return true;
    }
}
