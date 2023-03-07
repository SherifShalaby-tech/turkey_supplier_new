<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
class FirebaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:read_home')->only('index');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('testNotification');
    }

    public function savePushNotificationToken(Request $request)
    {

        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function sendPushNotification(Request $request)
    {
         $users = User::where('id',\Auth::id())->whereNotNull('device_token')->get();
         $url='/app/orders/list';

        sendNotification('تم ارسال طلب جديد','New Order Sended',$users,$url);


        // dd($response);
    }

}
