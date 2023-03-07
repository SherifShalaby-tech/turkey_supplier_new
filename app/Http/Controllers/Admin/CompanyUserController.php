<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyUserController extends Controller
{

    public function index($id)
    {
        $company = Company::whereId($id)->with('users')->first();
        return view('Admin.user.index',compact('company'));
    }

    public function edit(Company $company)
    {
        $company = $company->load('users');
        return view('Admin.user.edit',compact('company'));
    }
    public function update(CompanyRequest $request, Company $company)
    {
        $company->users->update([
            'name' =>$request->name,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'country' =>$request->country,
        ]);
        Alert::success('success', 'تم التعديل بنجاح');
        return redirect()->route('admin.users.index');
    }

    public function destroy(Company $company)
    {
        $company->users->detach();
        Alert::success('success', trans('تم الحذف بنجاح'));
        return redirect()->back();
    }
}
