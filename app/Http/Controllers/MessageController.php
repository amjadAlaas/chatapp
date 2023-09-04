<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($receiver_id)
    {

        $receiver = User::findOrFail($receiver_id);
        $sender = Auth::user();

        $messages = Message::where(function ($query) use ($sender, $receiver) {
            $query->where('sender_id', $sender->id)
                ->where('receiver_id', $receiver->id);
        })->orWhere(function ($query) use ($sender, $receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', $sender->id);
        })->get();

        return view('index', compact('messages', 'sender', 'receiver'));

    }
    public function store($receiver_id, Request $request)
    {

        $sender_id = Auth::user()->id;
        $message = $request->message;
        $newMessage = Message::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message,
        ]);
        event(new SendMessage($message));
        return response()->json(['data' => $newMessage, 'msg' => 'message sent', 'code' => 200]);
    }
}
