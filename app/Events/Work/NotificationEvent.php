<?php

namespace App\Events\Work;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $from_id;
    private int $to_id;

    /**
     * Create a new event instance.
     */
    public function __construct(int $from_id, int $to_id)
    {
        //
        $this->from_id = $from_id;
        $this->to_id = $to_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('notify_'.$this->to_id),
        ];
    }



    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'notify';
    }


    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'from_id' => $this->from_id,
            'to_id' => $this->to_id
        ];
    }
}
