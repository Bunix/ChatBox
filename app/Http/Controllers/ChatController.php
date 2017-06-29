<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\Events\MessageSent;
use App\User;
use Illuminate\Http\Request;
use Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($friend_id) {
        $friend = User::whereId($friend_id)->first();
        if (!$friend) {
            abort(404);
        }
        $conversation = Conversation::whereIn('user_one_id', [$friend->id, Auth::user()->id])->whereIn('user_two_id', [$friend_id, Auth::user()->id])->first();
        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->user_one_id = Auth::user()->id;
            $conversation->user_two_id = $friend->id;
            $conversation->save();
            //$conversation_id = $conversation->id;
        }
        return view('chat')->with(['friend' => $friend, 'conversation' => $conversation]);
    }

    public function getMessages($friend_id) {
        $friend = User::whereId($friend_id)->first();
        $conversation = Conversation::whereIn('user_one_id', [$friend->id, Auth::user()->id])->whereIn('user_two_id', [$friend_id, Auth::user()->id])->first();
        return Message::where('conversation_id', $conversation->id)->with('user')->get();
    }

    public function sendMessage(Request $request) {
        $user = Auth::user();
//        $conversation = Conversation::whereIn('user_one_id', [$request->friend_id, $user->id])->whereIn('user_two_id', [$request->friend_id, $user->id])->first();

//        $message = $user->messages()->create([
//           'message' => $request->message,
//            'conversation_id' => $conversation_id
//        ]);
        $message = new Message();
        $message->message = $request->message['message'];
        $message->read = 1;
        $message->conversation_id = $request->message['conversation_id'];
        $message->user_id = $user->id;
        $message->save();
        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
