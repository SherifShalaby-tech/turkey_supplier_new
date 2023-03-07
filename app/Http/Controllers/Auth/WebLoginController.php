<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Register;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class WebLoginController extends Controller
{


    public function login()
    {
    //   return view('auth.webLogin');
    if(Auth::guard('admin')->check()){
        // return false;
        return redirect(RouteServiceProvider::HOME);
    }elseif(Auth::guard('company')->check()){
        // return false;
        return redirect(RouteServiceProvider::HOME);
    }elseif(Auth::guard('clerk')->check()){
        return redirect(RouteServiceProvider::HOME);
    }else{
        return view('auth.webLogin');
    }
    }

    // post login
    public function postLogin(Request $request){
        try{
            $remember = $request->remember;
            if(auth()->guard('company')->attempt(
                ['email' => $request->email,
                    'password' => $request->password,
                    'trade_role' => 'seller'
                ]
                    ,$remember)){
                        return redirect(RouteServiceProvider::ADMIN);
            }elseif(auth()->guard('company')->attempt(
                ['email' => $request->email,
                    'password' => $request->password,
                    'trade_role' => 'buyer'
                ]
                ,$remember)){
                return redirect(RouteServiceProvider::HOME);
            }elseif(auth()->guard('clerk')->attempt(
                [
                 'email' => $request->email,
                 'password' => $request->password,
                ]
                ,$remember)){
                    return redirect(RouteServiceProvider::ADMIN);
            }else{
                Alert::error('error msg','email or password not correct !');
                return redirect()->back();
            }
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function postRegister(Register $request){
        try{
            $request->validated();
            if(Company::where('email',$request->email)->exists()){
                Alert::error('error msg','Email already exists');
                return redirect()->back();
            }
            if(company::where('phone',$request->phone . $request->phone2)->exists()){
                Alert::error('error msg','phone already exists');
                return redirect()->back();
            }
            $user_create = Company::create([
               'country' => $request->country,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'trade_role' => $request->trade_role,
                'name' => $request->full_name,
                'agree' => $request->agree,
                'phone' => $request->phone . $request->phone2,
                'type' => 'supplier'
            ]);
            if($request->trade_role == 'seller'){
                $user_create->attachRole('company');
                auth('company')->loginUsingId($user_create->id);
                return redirect()->intended(route('admin.home'));
            }else{
                    auth('company')->loginUsingId($user_create->id);
                 return redirect(route('website.index'));
            }
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function register()
    {
      return view('auth.webRegister');
    }

    public function logout(){
        auth('company')->logout();
        return redirect(route('webLogin'));
    }
    public function logoutclerk(){
        auth('clerk')->logout();
        return redirect(route('webLogin'));
    }
}
