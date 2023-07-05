<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediationRequest;
use App\Models\Mediation;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class TranslationController extends Controller
{
    public function index(){
        try{
            $translations = Translation::latest()->paginate(10);
            return view('Admin.translations.index',compact('translations'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function store(Request $request)
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
            $path = public_path('images/translations/' . $file_name);
            Image::make($image->getRealPath())->save($path);
            $input['image'] = $file_name;
        }
        $input['admin_add'] = Auth::user()->name;
        $input['description'] = $request->description;
        $input['created_at'] = now();
        $input['updated_at'] = now();
        Translation::create($input);
        Alert::success(trans('admins.success'), trans('admins.add-succes'));
        return redirect()->back();
    }

    public function edit($id){
        $translation = Translation::where('id',$id)->first();
        return view('Admin.translations.btn.edit',compact('translation'));
    }

    public function update(Request $request, Translation $translation)
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
            if($translation->image != null && file_exists(public_path('images/translations/' . $translation->image))){
                unlink(public_path('images/translations/' . $translation->image));
            }
            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
            $path = $path = public_path('images/mediations/' . $file_name);;
            Image::make($image->getRealPath())->save($path);
            $input['image'] = $file_name;
        }
        $translation->update($input);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->back();
    }

    public function destroy(Translation $translation)
    {
        if($translation->image != null && file_exists(public_path('/images/translations/' . $translation->image))){
            unlink('images/translations/' . $translation->image);
        }
        $translation->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }
}
