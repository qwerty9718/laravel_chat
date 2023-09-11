<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'id' => $this->id,
//            'body' => $this->body,
//            'time' => $this->created_at->diffForHumans()

            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'time_create' => $this->created_at->diffForHumans(),
            'time_update' => $this->updated_at->diffForHumans(),
            'surname' => $this->surname,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'avatar_url' => $this->avatar_url
        ];
    }
}
