<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSupplier;

class MessageController extends Controller
{
    public function messages()
    {
        $messages = ContactSupplier::get();
        return view('Admin.message.index',compact('messages'));
    }

    public function getSingleMessage($id)
    {
        $message = ContactSupplier::with('user')->whereId($id)->first();
        return response()->json([
            'message' => $message,
            'status' => true
        ]);
    }
}
