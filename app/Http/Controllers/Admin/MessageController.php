<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function index() {
        $userId = auth()->user()->id;

        $chatUsers = Chat::with('senderProfile')->select(['sender_id'])
        ->where('receiver_id', $userId)
        ->where('sender_id', '!=', '$userId')
        ->groupBy('sender_id')->get();
        return view("admin.messenger.index", compact("chatUsers"));
    }

    function getMessages(Request $request) {
        $senderId = auth()->user()->id;
        $receiverId = $request->receiver_id;
     
        $messages = Chat::whereIn('receiver_id', [$senderId, $receiverId])
        ->whereIn('sender_id', [$senderId, $receiverId])
        ->orderBy('created_at', 'asc')->get();

        return response($messages);
    }

    function sendMessages(Request $request) {
        $request->validate([
            'message' => ['required'],
            'receiver_id' => ['required'],
        ]);

        $message = new Chat();
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return response(['status' => 'success','message'=> 'message sent successfully']);
    }
    
}
