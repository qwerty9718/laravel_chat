<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'time_create' => $this->created_at->diffForHumans(),
            'time_update' => $this->updated_at->diffForHumans(),
            'user_id' => $this->user_id,
            'chat_room_id' => $this->chat_room_id,
            'status' => $this->status,
            'name' => $this->name,

        ];
    }
}
