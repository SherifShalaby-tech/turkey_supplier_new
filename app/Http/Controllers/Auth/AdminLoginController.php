<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMIN;
    // protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest:admin,company', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        // if(!Auth::guard('admin')->user() || !Auth::guard('company')->user()){
        //     return view('auth.admin.login');
        // }else{
        //     return 'hello';
        // }

        if(Auth::guard('admin')->check()){
            // return false;
            return redirect(RouteServiceProvider::ADMIN);
        }elseif(Auth::guard('company')->check()){
            // return false;
            return redirect(RouteServiceProvider::ADMIN);
        }else{
            return view('auth.admin.login');
        }
    }

    public function username()
    {
        return 'email';
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            // return redirect()->intended(route('admin.home'));
            return redirect(RouteServiceProvider::ADMIN);
        }
        // elseif (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password,'trade_role' => 'seller'])) {
        //     return redirect(RouteServiceProvider::ADMIN);
        // }
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
