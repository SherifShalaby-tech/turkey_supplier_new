<?php

use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Session\Session;

// decode base 64 images
function decodeBase64Image($base64Image) {

    // Decode the base64-encoded image
    $imageData = base64_decode(explode(",",$base64Image)[1]);

    // Get the image size and type
    list($width, $height, $type) = getimagesizefromstring($imageData);

    // Get the file type
    $fileType = image_type_to_mime_type($type);

    // Get the file size in bytes
    $fileSize = strlen($imageData);

    // Generate a unique file name
    $fileName = "_".uniqid() . '.' . explode("/",$fileType)[1];

    // Return an associative array containing the file name, file size, and file type
    return array(
        'name' => $fileName,
        'size' => $fileSize,
        'type' => $fileType
    );
}
function getBase64Image($Image)
{

    $image_path = str_replace(env("APP_URL") . "/", "", $Image);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $image_path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $image_content = curl_exec($ch);
    curl_close($ch);
   //    $image_content = file_get_contents($image_path);
    $base64_image = base64_encode($image_content);
    $b64image = "data:image/jpeg;base64," . $base64_image;
    return  $b64image;
}
function getCroppedImages($cropImages){
    $dataNewImages = [];
    foreach ($cropImages as $img) {
        if (strlen($img) < 200){
            $dataNewImages[] = getBase64Image($img);
        }else{
            $dataNewImages[] = $img;
        }
    }
    return $dataNewImages;
}


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


    function get_price($price){
        $currency=request()->session()->get('currency');
        $setting = Setting::where('currency_id',$currency->id)->first();
        $new_price= $price;
        // $code = ' $';
        if( $currency->code == "TRY"){
            $new_price = $price * $setting->rate;
            // $code = ' ₺';
        }
        return $new_price;

    }

    function get_currency_co(){
        $currency_session =request()->session()->get('currency');
        $currency =  Currency::where('id',$currency_session->id)->first();
        // currency
        return $currency->symbol;

    }




}
