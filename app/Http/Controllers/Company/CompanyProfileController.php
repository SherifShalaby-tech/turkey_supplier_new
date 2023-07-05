<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ProfilepassRequest;
use App\Http\Requests\updatecompanyRequest;
use App\Models\Company;
use App\Models\Media;
use App\Models\Plan;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CompanyProfileController extends Controller
{

    public function profile()
    {
        $company = Auth::guard('company')->user();
        return view('Company.profile', compact('company'));
    }
    public function changePassword(ProfilepassRequest $request, $id)
    {
        try {
            $request->validated();
            $company = Company::findOrFail(Auth::user()->id);
            if ($company) {
                $company->password = Hash::make($request->password);
                $company->save();
                // session()->flash('password_message','Password has been updated successfully');
                Alert::success(trans('admins.success'), trans('profile.updated-succes'));
            } else {
                // session()->flash('password_error','Password does not match');
                Alert::error(trans('profile.error'), trans('profile.notmatch'));
            }
            // Alert::success(trans('admins.success'), trans('profile.delete-succes'));
            return redirect()->back();
        } catch (\Exception $exception) {
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
        // dd($company);
        // $company=Auth::guard('company')->user();
    }
    public function updatecompany(updatecompanyRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->validated();
            $company = Company::where('id',Auth::user()->id)->first();
            if (!empty($request->translations)) {
                $company->translation = $request->translations;
            } else {
                $company->translation = [];
            }
            $company->description = $request->description;
            $company->plan_id = $request->plan_id;
            $company->name = $request->name;
            $company->email = $request->email;
            $company->cod = $request->cod;
            $company->phone = $request->phone;
            $company->phone1 = $request->phone1;
            $company->phone2 = $request->phone2;
            $company->phone3 = $request->phone3;
            $company->country = $request->country;
            $company->admin_edit = Auth::user()->name;
            $company->save();
            if ($request->images && count($request->images) > 0) {
                $i = $company->media()->count() + 1;
                if(auth('company')->user()){
                    if (count($request->images) > auth('company')->user()->plan->company_picture_count){
                        Alert::error('error msg','عدد الصور كبير جدا عن المتاح فى الباقة');
                        return redirect()->back();
                    }
                    if (Media::where('mediable_id',$company->id)->count() > auth('company')->user()->plan->product_picture_count){
                        Alert::error('error msg','عدد الصور كبير جدا عن المتاح فى الباقة');
                        return redirect()->back();
                    }
                }
                foreach ($request->images as $image) {
                    $file_name = Str::slug($company->name) . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('images/companies/' . $file_name);
                    Image::make($image->getRealPath())->save($path);
                    $company->media()->create([
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
            // return redirect()->route('admin.companies.index');
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollback();
            Alert::error('error msg', $exception->getMessage());
            return redirect()->back();
        }
    }
}
