<?php

namespace App\Http\Controllers\Work;

use App\Events\Work\DeleteUserEvent;
use App\Events\Work\UploadUserImageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Work\UserImageRequest;
use App\Http\Requests\Work\UserRequest;
use App\Models\ChatRoom;
use App\Models\ChatUserTable;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function updateUser(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);


        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'city' => $data['city'],
        ]);

    }


    public function uploadImg(UserImageRequest $request){
        $data = $request->validated();
        $image = $data['avatar'];

        $user = User::find($data['user_id']);
        $current_image = $user->images;
        if (count($current_image) > 0){
            foreach ($current_image as $del_image){
                Storage::disk('public')->delete($del_image->path);
                $del_image->delete($del_image);
            }
        }


        $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);
        $user_image =  UserImage::create([
            'path' => $filePath,
            'url' => url('/storage/' . $filePath),
            'user_id' => $data['user_id']
        ]);

        $user->update([
            'avatar_url' => $user_image['url']
        ]);


        broadcast(new UploadUserImageEvent($user))->toOthers();
        return $user_image['url'];
    }


    public function getUserImage($id){
        $user = User::find($id);
        $image = $user->images;
        return $image[0];
    }



    public function deleteAccount($id){
        $user = User::findOrFail($id);

        $images = $user->images;
        if (count($images) > 0){
            foreach ($images as $del_image){
                Storage::disk('public')->delete($del_image->path);
                $del_image->delete($del_image);
            }
        }

        $chat_user_tables = ChatUserTable::where('user_id',$user['id'])->get();
        // Удаление Сообщений
        if (count($chat_user_tables) > 0){
            foreach ($chat_user_tables as $item){
                $chat_rooms = ChatRoom::where('id', $item['chat_room_id'])->get();
                if (count($chat_rooms) > 0){
                    foreach ($chat_rooms as $room){
                        $messages = Message::where('chat_room_id',$room['id'])->get();
                        if (count($messages) > 0){
                            foreach ($messages as $message){
                                $message->delete();
                            }
                        }
                    }
                }
            }
        }

        // Удаление Сообщений
        if (count($chat_user_tables) > 0){
            foreach ($chat_user_tables as $item){
                $chat_rooms = ChatRoom::where('id', $item['chat_room_id'])->get();
                if (count($chat_rooms) > 0){
                    foreach ($chat_rooms as $room){

                        $others_chat_user_tables = ChatUserTable::where('chat_room_id',$room['id'])->get();
                        if (count($others_chat_user_tables) > 0){
                            foreach ($others_chat_user_tables as $other){
                                $other->delete();
                            }
                        }
                    }

                    foreach ($chat_rooms as $room){
                        $room->delete();
                    }
                }
            }
        }

        $notify = $user->getNotify;
        if (count($notify) > 0){
            foreach ($notify as $noty){
                $noty->delete();
            }
        }
        broadcast(new DeleteUserEvent($user))->toOthers();

        $user->delete();
        return '/';
    }

}
