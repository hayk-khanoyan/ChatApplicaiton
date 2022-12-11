<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserMessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'message' => $this->resource->message,
            'sender' => $this->resource->sender?->name ?? '',
            'sender_id' => $this->resource->sender_id,
            'receiver_id' => $this->resource->receiver_id,
            'send_at' => $this->resource->created_at->diffForHumans(),
        ];
    }
}
