<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\UserMessage;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property UserMessage $resource */
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
