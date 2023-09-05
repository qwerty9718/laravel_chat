<?php

namespace App\Events\Work;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateNewChatRoomEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private ChatRoom $chat_room;
    private User $second_user;
    private User $me;


    /**
     * Create a new event instance.
     */
    public function __construct(ChatRoom $chat_room,User $second_user, User $me)
    {

        $this->chat_room = $chat_room;
        $this->second_user = $second_user;
        $this->me = $me;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
//            new Channel('rooms_chat_'.$this->chat_room->id.'_user_'.$this->second_user->id),
            new Channel('rooms_chat_'.$this->chat_room->id.'_user_'.$this->me->id.'_second_'.$this->second_user->id),
        ];
    }


    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'rooms_chat';
    }


    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'result' => 'OKKKKKKKKKKK'
        ];
    }
}
