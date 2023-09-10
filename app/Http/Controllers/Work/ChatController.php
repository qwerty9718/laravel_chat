<?php

namespace App\Http\Controllers\Work;


use App\Events\Work\NotificationEvent;
use App\Events\Work\SendMessageToRoomEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Prototype\SendMessageRequest;
use App\Http\Requests\Work\CreateChatRequest;
use App\Http\Requests\Work\DeleteNotifyRequest;
use App\Http\Requests\Work\GetChatRequest;
use App\Models\ChatRoom;
use App\Models\ChatUserTable;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Ramsey\Collection\add;

class ChatController extends Controller
{
    public function index(){
        $users = User::all();
        $me = auth()->user();
        $notifications = $me->getNotify;
        return inertia('Work/Index', compact('users','me', 'notifications'));
    }


    public function getChatRooms(GetChatRequest $request){
        $data = $request->validated();
        $firsUserRooms = User::find($data['me'])->getMyChatRooms;
        $secondUser = User::find($data['secondUser']);
        $secondUserRoom = $secondUser->getMyChatRooms;

        foreach ($firsUserRooms as $fRoom){
            foreach ($secondUserRoom as $sRoom){
                if ($fRoom->id  == $sRoom->id){
//                    $messages = $fRoom->messages($fRoom->id)->orderBy('created_at', 'desc')->paginate(5);
                    $messages = $fRoom->messages($fRoom->id)->orderBy('created_at', 'desc')->paginate(20);
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

    public function setNotification(int $me, int $second_user){

        $notifications = User::find($second_user)->getNotify;
        $create = true;
        foreach ($notifications as $item){
            if ($item['user_id'] == $second_user && $item['from_id'] == $me){
                $create = false;
                break;
            }
        }
        if ($create == true){
            $notify = Notification::create(['user_id' => $second_user, 'from_id' => $me]);
        }

    }


    public function deleteNotification(DeleteNotifyRequest $request){
        $data = $request->validated();
        $notify = Notification::where('user_id',$data['me_id'])->where('from_id',$data['second_user_id'])->get();
        if (isset($notify[0]['id'])){
            $id = $notify[0]['id'];
            DB::table('notifications')->where('id', $id)->delete();
        }
    }


    public function sendMessage(SendMessageRequest $request){
        $data = $request->validated();

        $second_user_id = $data['second_user_id'];
        unset($data['second_user_id']);

        $message = Message::create($data);

        $this->setNotification($data['user_id'],$second_user_id);

        broadcast(new SendMessageToRoomEvent($message))->toOthers();
        broadcast(new NotificationEvent($message['user_id'],$second_user_id))->toOthers();

        return $message;
    }


    public function loadMoreMessages($id){
        $chat_room = ChatRoom::findOrFail($id);
//        $messages = $fRoom->messages($fRoom->id)->orderBy('created_at', 'desc')->paginate(5);
        $messages = $chat_room->messages($chat_room->id)->orderBy('created_at', 'desc')->paginate(20);
        return $messages;
    }

}
