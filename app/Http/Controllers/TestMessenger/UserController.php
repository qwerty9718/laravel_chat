<?php

namespace App\Http\Controllers\TestMessenger;


use App\Events\TestMessenger\SendLikeEvent;
use App\Events\TestMessenger\SendMyMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestMessenger\SendLikeRequest;
use App\Http\Requests\TestMessenger\SendMessageRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function getAll(){
        $all_users = User::latest()->get();
        return inertia('TestMessenger/All_Users', compact( 'all_users'));
    }


    public function sendLike($id,SendLikeRequest $request){
        $user = User::findOrFail($id);
        $data = $request->validated();
        $like_str = 'You got like from user with id '. $data['from_id'] ;

        broadcast(new SendLikeEvent($like_str, $user->id))->toOthers();

        return response()->json([
            'like_str' => $like_str
        ]);
    }


    public function sendMessage($id, SendMessageRequest $request){
        $user = User::findOrFail($id);
        $data = $request->validated();
        $res = 'You got Message from user '. $data['from_email'] . '---- '. $data['message'];

        broadcast(new SendMyMessageEvent($user->id, $res))->toOthers();

        return response()->json([
            'answer' => 'status Ok'
        ]);
    }



}
