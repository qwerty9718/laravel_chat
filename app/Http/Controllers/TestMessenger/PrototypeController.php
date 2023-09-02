<?php

namespace App\Http\Controllers\TestMessenger;

use App\Events\Prototype\SendMessageEvent;
use App\Events\Prototype\SendMessageToRoomEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Prototype\SendMessageRequest;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class PrototypeController extends Controller
{

    /// Получаем все чаты пользователя
    public function myPage($id){
        $me = User::find($id);
        $chat_room = $me->getMyChatRooms;
        return inertia('Prototype/MyPage', compact('me','chat_room'));
    }

    /// Получаем конкретный чат (всех его пользователей и сообщния)
    public function myRoom($id){
        $room = ChatRoom::find($id);
        $users = $room->users;
        $messages = $room->messages($room->id)->get();
        $data = ['room' => $room, 'messages' => $messages, 'users' => $users];

        return $data;
    }


    public function sendMessage(SendMessageRequest $request){
        $data = $request->validated();

        $message = Message::create($data);

        broadcast(new SendMessageToRoomEvent($message))->toOthers();
        return $message;
    }
}
