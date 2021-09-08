<?php

namespace App\Http\Controllers;

use App\Message;

use App\Events\MessageEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('page.common.chat');
    }

    public function fetchMessages()
    {
        return Message::with('User')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        // $message = $user->Messages()->create([
        //     'message' => $request->input('message')
        // ]);

        // broadcast(new MessageEvent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
