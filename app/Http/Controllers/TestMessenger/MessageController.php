<?php

namespace App\Http\Controllers\TestMessenger;

use App\Events\TestMessenger\StoreMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestMessenger\StoreRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::latest()->get();
        return inertia('TestMessenger/Index',compact('messages'));
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $message = Message::create($data);

        broadcast(new StoreMessageEvent($message))->toOthers();

        return $message;
    }



}
