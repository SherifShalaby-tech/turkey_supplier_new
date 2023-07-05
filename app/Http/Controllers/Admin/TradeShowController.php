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

    public function data()
    {
        $tradeShows = TradeShow::select();
        return DataTables::of($tradeShows)
            ->addIndexColumn()
            ->addColumn('actions', function (TradeShow $tradeShow) {
                return view('Admin.tradeShow.data_table.actions', compact('tradeShow'));
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
            ->rawColumns(['linkurl', 'videourl'])
            ->toJson();
    }

    public function create()
    {
        return view('Admin.tradeShow.create');
    }

    public function store(TradeShowRequest $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $request->validated();
            $tradeShow = new TradeShow();
            if (!empty($request->translations)) {
                $tradeShow->translation = $request->translations;
            } else {
                $tradeShow->translation = [];
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


            if ($request->cropImages && count($request->cropImages) > 0) {
                $i = 1;
                foreach ($request->cropImages as $image) {
                    $imageData = $this->decodeBase64Image($image);
                    $file_name = Str::slug($request->name) . '_' . time() . '_' . $i . '.' . explode("/", $imageData["type"])[1];
                    $path = public_path('images/tradeShows/' . $file_name);
                    $imagee = Image::make(base64_decode(explode(",", $image)[1]));
                    $imagee->save($path);
                    $tradeShow->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $imageData["size"],
                        'file_type' => $imageData["type"],
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;

                }
            }

            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.add-succes'));
            return redirect()->route('admin.tradeShows.index');
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function edit(TradeShow $tradeShow)
    {
        return view('Admin.tradeShow.edit', compact('tradeShow'));
    }

    public function update(TradeShowRequest $request, TradeShow $tradeShow)
    {
//        dd($request->all());
        DB::beginTransaction();
//        try {
            if (!empty($request->translations)) {
                $tradeShow->translation = $request->translations;
            } else {
                $tradeShow->translation = [];
            }
            $tradeShow->update([
                'title' => $request->title,
                'details' => $request->description,
                'linkurl' => $request->linkurl,
                'videourl' => $request->videourl,
                'admin_edit' => Auth::user()->name,
            ]);
            if ($request->cropImages && count($request->cropImages) > 0) {
                $i = $tradeShow->media()->count() + 1;
                foreach (getCroppedImages($request->cropImages) as $image) {
                    $imageData = $this->decodeBase64Image($image);
                    if ($tradeShow->media()->count() > 0) {
                        foreach ($tradeShow->media as $media) {
                            if (File::exists(public_path('images/tradeShows/' . $media->file_name))) {
                                @unlink('images/tradeShows/' . $media->file_name);
                            }
                            $media->delete();
                        }
                    }

                    $file_name = Str::slug($tradeShow->name) . '_' . time() . '_' . $i . '.' . explode("/", $imageData["type"])[1];
                    $path = public_path('images/tradeShows/' . $file_name);
                    $imagee = Image::make(base64_decode(explode(",", $image)[1]));
                    $imagee->save($path);
                    $tradeShow->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $imageData["size"],
                        'file_type' => $imageData["type"],
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
            DB::commit();
            Alert::success(trans('admins.success'), trans('admins.update-succes'));
            return redirect()->route('admin.tradeShows.index');
//        } catch (\Exception $exception) {
//            Alert::error('error msg', $exception->getMessage());
//            return redirect()->back();
//        }
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
        if (!is_null($tradeShow->video)) {
            $path = public_path() . '/videos/tradeShows/' . $tradeShow->video;
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

    function decodeBase64Image($base64Image)
    {

        // Decode the base64-encoded image
        $imageData = base64_decode(explode(",", $base64Image)[1]);

        // Get the image size and type
        list($width, $height, $type) = getimagesizefromstring($imageData);

        // Get the file type
        $fileType = image_type_to_mime_type($type);

        // Get the file size in bytes
        $fileSize = strlen($imageData);

        // Generate a unique file name
        $fileName = "_" . uniqid() . '.' . explode("/", $fileType)[1];

        // Return an associative array containing the file name, file size, and file type
        return array(
            'name' => $fileName,
            'size' => $fileSize,
            'type' => $fileType
        );
    }
}
