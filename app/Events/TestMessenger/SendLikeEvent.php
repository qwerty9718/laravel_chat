<?php

namespace App\Events\TestMessenger;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendLikeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $like_str;
    private int $userId;

    /**
     * Create a new event instance.
     */
    public function __construct(string $like_str, int $userId)
    {
        $this->like_str = $like_str;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('send_like_'.$this->userId),
        ];
    }


    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'send_like';
    }


    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'like_str' => $this->like_str,
        ];
    }
}
