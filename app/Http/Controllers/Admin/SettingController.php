<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\about_us;
use App\Http\Requests\SettingRequest;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Setting;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:read_contactus')->only(['index']);
    //     $this->middleware('permission:create_contactus')->only(['create', 'store']);
    //     $this->middleware('permission:update_contactus')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_contactus')->only(['delete']);

    // }// end of __construct

    public function edit()
    {
        $setting = Setting::first();
        return view('Admin.setting.edit',compact('setting'));
    }
//,Setting $setting
    public function update(SettingRequest $request)
    {
        $setting = Setting::first();
        // if($request->logo){
        //     $ext = '.'.$request->file('logo')->getClientOriginalExtension();
        //         $file_name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->logo->getClientOriginalName());
        //         $imageResize = Image::make($request->logo->getRealPath());
        //         $file_name = $request->logo->getClientOriginalName();
        //         $imageResize->resize(200, 200, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })->save(public_path('images/logo/' . $file_name));
        //         $path = public_path().'/images/logo/' . $file_name;
        //     $setting->update([
        //         'logo' =>$path,
        //     ]);
        // }
        $input['company_name'] = $request->company_name;
        $input['company_phone'] = $request->company_phone;
        $input['company_address'] = $request->company_address;
        $input['email'] = $request->email;
        $input['city'] = $request->city;
        $input['facebook'] = $request->facebook;

        $input['instagram'] = $request->instagram;
        $input['youtube'] = $request->youtube;
        $input['whatsapp'] = $request->whatsapp;
        $input['ipan'] = $request->ipan;
        $input['rate'] = $request->rate;
        $input['linkedin'] = $request->linkedin;
        $input['phone'] = $request->phone;
        $input['metadesc'] = $request->metadesc;
        $input['metakeyword'] = $request->metakeyword;
        if ($image = $request->file('logo')) {
            if($setting->logo != null && file_exists(public_path('/images/logo/' . $setting->logo))){
                unlink('images/logo/' . $setting->logo);
            }
            $file_name = Str::slug($request->company_name).".".$image->getClientOriginalExtension();
            $path = public_path('/images/logo/' . $file_name);
            Image::make($image->getRealPath())->save($path);
            $input['logo'] = $file_name;
        }
        $setting->update($input);
        // $setting->update([
        //     'company_name' =>$request->company_name,
        //     'company_phone' =>$request->company_phone,
        //     'company_address' =>$request->company_address,
        //     'email' =>$request->email,
        //     'city' =>$request->city,
        //     'facebook' =>$request->facebook,
        //     'linkedin' =>$request->linkedin,
        //     'phone' =>$request->phone,
        //     'metadesc' =>$request->metadesc,
        //     'metakeyword' =>$request->metakeyword,
        // ]);
        Alert::success(trans('admins.success'), trans('admins.update-succes'));
        return redirect()->route('admin.settings.edit');
    }

    public function about_us(){
        try{
            $about_us = AboutUs::first();
            return view('Admin.setting.about_us',compact('about_us'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function post_about_us(about_us $request){
        try{
            toast('updated success','success');
            $request->validated();
            $about_us = AboutUs::first();
            if($request->images){
                foreach ($request->images as $image){
                    $ext = '.'.$image->getClientOriginalExtension();
                    $file_name = str_replace($ext, date('d-m-Y-H-i') . $ext, $image->getClientOriginalName());
                    $imageResize = Image::make($image->getRealPath());
                    $file_name = $image->getClientOriginalName();
                    $imageResize->save(public_path('images/about_us/' . $file_name));
                    $about_us->images = [$file_name];
                }
            }
            if(!empty($request->translations))
            {
                $about_us->translation = $request->translations;
            }else{
                $about_us->translation=[];
            }
            $about_us->about_us = $request->about_us;
            $about_us->services = $request->services;
            $about_us->shipping_products = $request->shipping_products;
            $about_us->mediation = $request->mediation;
            $about_us->save();
            return redirect()->back();
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function contactData(){
        $messages = Contact::select();
        return DataTables::of($messages)
            ->addIndexColumn()
            ->editColumn('created_at', function (Contact $contact) {
                return $contact->created_at->format('Y-m-d');
            })
            ->toJson();
    }

    public function contactus(){
        try{
            return view('Admin.setting.contact');
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
