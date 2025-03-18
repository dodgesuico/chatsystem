<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all(); // Fetch all users
        $selectedUser = null;
        $messages = [];

        if ($request->has('user_id')) {
            $selectedUser = User::find($request->user_id);
            $messages = Message::where(function ($query) use ($selectedUser) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $selectedUser->id);
            })->orWhere(function ($query) use ($selectedUser) {
                $query->where('sender_id', $selectedUser->id)
                    ->where('receiver_id', auth()->id());
            })->orderBy('created_at')->get();
        }

        return view('index', compact('users', 'selectedUser', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        Messages::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent.');
    }


}
