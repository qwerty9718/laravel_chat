<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Requests\Work\CreateChatRequest;
use App\Http\Requests\Work\GetChatRequest;
use App\Models\ChatRoom;
use App\Models\ChatUserTable;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){
        $users = User::all();
        $me = auth()->user();
        return inertia('Work/Index', compact('users','me'));
    }


    public function getChatRooms(GetChatRequest $request){
        $data = $request->validated();
        $firsUserRooms = User::find($data['me'])->getMyChatRooms;
        $secondUser = User::find($data['secondUser']);
        $secondUserRoom = $secondUser->getMyChatRooms;

        foreach ($firsUserRooms as $fRoom){
            foreach ($secondUserRoom as $sRoom){
                if ($fRoom->id  == $sRoom->id){
                    $messages = $fRoom->messages($fRoom->id)->get();
                    if (count($messages) <= 0 ){
                        return  $data = ['messages' => [],'second_user' => $secondUser,'current_chat' => $fRoom, 'status_chat' => 'no messages'];
                    }
                    else{
                        return $data = ['messages' => $messages,'second_user' => $secondUser,'current_chat' => $fRoom, 'status_chat' => 'ok'];
                    }
                }
            }
        }

        return  $data = ['messages' => [],'second_user' => $secondUser,'current_chat' => null,'status_chat' => 'no chats'];
    }



    public function crateChatRoom(CreateChatRequest $request){
        $data = $request->validated();
        $firsUserRooms = User::find($data['me'])->getMyChatRooms;
        $secondUserRoom = User::find($data['second_user'])->getMyChatRooms;
        $checkExistsChat = null;
        foreach ($firsUserRooms as $fRoom){
            foreach ($secondUserRoom as $sRoom){
                if ($fRoom->id  == $sRoom->id){
                    $checkExistsChat = $fRoom;
                    break;
                }
            }
        }

        if ($checkExistsChat == null){
            $chatRoom = ChatRoom::create(['name' => $data['name']]);
            ChatUserTable::create(['chat_room_id' => $chatRoom->id, 'user_id' => $data['me']]);
            ChatUserTable::create(['chat_room_id' => $chatRoom->id, 'user_id' => $data['second_user']]);
            $data = ['messages' => $chatRoom->messages($data['second_user'])->get(), 'chat_room_id' => $chatRoom->id, 'status_chat' => 'no messages'];
        }

        if ($checkExistsChat != null){
            $data = ['messages' => $checkExistsChat->messages($data['second_user'])->get(), 'chat_room_id' => $checkExistsChat->id, 'status_chat' => 'ok'];
        }


        return $data;
    }
}
