<?php

use App\Models\Notification;
use Illuminate\Support\Facades\Storage;


function sendNotification($message_ar ,$message_en,$receivers,$url=null)
{
    // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
    $SERVER_API_KEY = 'AAAAKJJLZZI:APA91bFhPlyWiVWUyzGiJHb3tqCQcDp8NV1RNPm3EL9cPbfVKr9Fg_Zt6MkRl_i2kBrcoUWMgehCTDCk5VUn3iRimoazl_pX7YpJvr5vVnKifQTEmwZiw0nl8YkyPLElbz90f3EXx28z';

    $tokens=[];
    foreach ($receivers ??[] as $key => $value) {
        $tokens[]=$value->device_token;
    }

    $data = [
        "registration_ids" => $tokens,
        "notification" => [
            "title" => app()->getLocale() == 'ar' ? 'إشعار جديد' : 'New Notification' . '++'.$url,
            "body" => app()->getLocale() == 'ar' ? $message_ar : $message_en,
            "sound" => "default"
        ]
    ];
    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    //store notifications


    foreach ($receivers ??[] as $key => $value) {
        Notification::create([
            'receiver_id'=>$value->id,
            'sender_id'=>auth()->user()->id,
            'message_ar'=>$message_ar,
            'message_en'=>$message_en,
            'url'=>$url,
        ]);
    }
    // dd($response);




    function store_file($file,$path)
    {
        $name = time().$file->getClientOriginalName();
        return $value = $file->storeAs($path, $name, 'uploads');
    }
    function delete_file($file)
    {
        if(Storage::disk('uploads')->exists($file)){
            unlink('uploads/'.$file);
        }
    }
    function display_file($name)
    {
        return asset('uploads').'/'.$name;
    }

}
