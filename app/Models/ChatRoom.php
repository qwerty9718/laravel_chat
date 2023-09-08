<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function users(){
        return $this->belongsToMany(User::class, 'chat_user_tables','chat_room_id','user_id');
    }

//    public function messages($id){
//        return Message::where('chat_room_id', $id);
//    }


    public function messages($id){
        return Message::where('chat_room_id', $id);
    }
}
