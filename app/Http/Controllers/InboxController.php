<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index() {
        // Show just the users and not the admins as well
        $users = User::where('is_admin', false)->orderBy('id', 'DESC')->get();

        if (auth()->user()->is_admin == false) {
            $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        }

        return view('helpdesk.home', [
            'users' => $users,
            'messages' => $messages ?? null
        ]);
    }

    public function show($id) {
        if (auth()->user()->is_admin == false) {
            abort(404);
        }

        $sender = User::findOrFail($id);

        $users = User::with(['message' => function($query) {
            return $query->orderBy('created_at', 'DESC');
        }])->where('is_admin', false)
            ->orderBy('id', 'DESC')
            ->get();

        if (auth()->user()->is_admin == false) {
            $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        } else {
            $messages = Message::where('user_id', $sender)->orWhere('receiver', $sender)->orderBy('id', 'DESC')->get();
        }

        return view('helpdesk.show', [
            'users' => $users,
            'messages' => $messages,
            'sender' => $sender,
        ]);
    }
}
