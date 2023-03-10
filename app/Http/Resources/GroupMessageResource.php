<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\GroupMessage;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property GroupMessage $resource */
class GroupMessageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'message' => $this->resource->message,
            'sender' => $this->resource->sender->name,
            'sender_id' => $this->resource->sender->id,
            'send_at' => $this->resource->created_at->diffForHumans(),
        ];
    }
}
