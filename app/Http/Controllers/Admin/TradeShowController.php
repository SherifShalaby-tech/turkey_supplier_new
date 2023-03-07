<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TradeShowRequest;
use App\Models\TradeShow;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeShowController extends Controller
{

    public function index()
    {
        return view('Admin.tradeShow.index');
    }
    public function data() {
        $tradeShows = TradeShow::select();
        return DataTables::of($tradeShows)
        ->addIndexColumn()
            ->addColumn('actions', function (TradeShow $tradeShow) {
             return view('Admin.tradeShow.data_table.actions',compact('tradeShow'));
         })
        ->editColumn('created_at', function (TradeShow $tradeShow) {
            return $tradeShow->created_at->format('Y-m-d');
        })
        ->editColumn('updated_at', function (TradeShow $tradeShow) {
            return $tradeShow->updated_at->format('Y-m-d');
        })
        ->editColumn('linkurl', function (TradeShow $tradeShow) {
            return view('Admin.tradeShow.data_table.linkurl', compact('tradeShow'));
        })
        ->editColumn('videourl', function (TradeShow $tradeShow) {
            return view('Admin.tradeShow.data_table.videourl', compact('tradeShow'));
        })
         ->rawColumns(['linkurl','videourl'])
        ->toJson();
    }
    public function create()
    {
        return view('Admin.tradeShow.create');
    }
    public function store(TradeShowRequest $request)
    {
        // dd('ddddddddddd');
        DB::beginTransaction();
        try{
            $request->validated();
            $tradeShow = new TradeShow();
            if(!empty($request->translations))
            {
                $tradeShow->translation = $request->translations;
            }else{
                $tradeShow->translation=[];
            }
        // if($request->video){
        //     $file = $request->file('video');
        //     $filename = time().$file->getClientOriginalName();
        //     $path = public_path().'/videos/tradeShows/';
        //     $file->move($path, $filename);
        //     $tradeShow->video =$filename;
        // }
        $tradeShow->title = $request->title;
        $tradeShow->details = $request->description;
        $tradeShow->videourl = $request->videourl;
        $tradeShow->linkurl = $request->linkurl;
        $tradeShow->admin_add = Auth::user()->name;
        $tradeShow->save();
        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $image) {
                $file_name = Str::slug($request->name ) . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('images/tradeShows/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $tradeShow->media()->create([
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
        return redirect()->route('admin.tradeShows.index');
    }catch (\Exception $exception){
        Alert::error('error msg',$exception->getMessage());
        return redirect()->back();
    }
    }
    public function edit(TradeShow $tradeShow)
    {
        return view('Admin.tradeShow.edit',compact('tradeShow'));
    }
    public function update(TradeShowRequest $request, TradeShow $tradeShow)
    {
        // dd('ddddddddddd');
        DB::beginTransaction();
        try{
        if(!empty($request->translations))
        {
            $tradeShow->translation = $request->translations;
        }else{
            $tradeShow->translation=[];
        }

        // if($request->video){
        //     if(!is_null($tradeShow->video))
        //     {
        //         $path = public_path().'/videos/tradeShows/'.$tradeShow->video;
        //         unlink($path);
        //     }
        //     $file = $request->file('video');
        //     $filename = time().$file->getClientOriginalName();
        //     $path = public_path().'/videos/tradeShows/';
        //     $file->move($path, $filename);
        //     $tradeShow->video =$filename;
        // }

        $tradeShow->update([
            'title' =>$request->title,
            'details' =>$request->description,
            'linkurl' =>$request->linkurl,
            'videourl' =>$request->videourl,
            'admin_edit' => Auth::user()->name,
        ]);
        if ($request->images && count($request->images) > 0) {
            $i = $tradeShow->media()->count() + 1;
            foreach ($request->images as $image) {
                $file_name = Str::slug($tradeShow->name ) . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('images/tradeShows/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $tradeShow->media()->create([
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
        return redirect()->route('admin.tradeShows.index');
    }catch (\Exception $exception){
        Alert::error('error msg',$exception->getMessage());
        return redirect()->back();
    }
    }

    public function destroy(TradeShow $tradeShow)
    {
        if ($tradeShow->media()->count() > 0) {
            foreach ($tradeShow->media as $media) {
                if (File::exists(public_path('images/tradeShows/' . $media->file_name))) {
                    unlink('images/tradeShows/' . $media->file_name);
                }
                $media->delete();
            }
        }
        if(!is_null($tradeShow->video))
        {
            $path = public_path().'/videos/tradeShows/'.$tradeShow->video;
            unlink($path);
        }
        $tradeShow->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }

    public function remove_image(Request $request)
    {
        $tradeShow = TradeShow::findOrFail($request->tradeShow_id);
        $image = $tradeShow->media()->whereId($request->image_id)->first();
        if (File::exists('images/tradeShows/' . $image->file_name)) {
            unlink('images/tradeShows/' . $image->file_name);
        }
        $image->delete();
        return true;
    }
}
