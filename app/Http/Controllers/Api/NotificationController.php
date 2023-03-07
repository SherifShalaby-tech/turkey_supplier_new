<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = Notification::where('receiver_id', auth()->user()->id)->get();
        return response()->json([
            'data' => $notifications,
            'count' => count($notifications)
        ]);
    }
    public function getUnreadNotifications()
    {
        $notifications = Notification::where('receiver_id', auth()->user()->id)->whereNull('read_at')->get();
        return response()->json([
            'data' => $notifications,
            'count' => count($notifications)
        ]);
    }
    public function readNotification(Request $request)
    {
        $notification = Notification::find($request->notification_id);
        $notification->read_at = Carbon::now();
        $notification->save();
        return response()->json(['success' => 'Notification Readed']);
    }
}
