<?php

namespace App\Http\Resources;

use App\Models\Group;
use Illuminate\Http\Resources\Json\JsonResource;


class MessageHistoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'message_id' => $this->resource->messageable->id,
            'name' => $this->resource->messageable->name,
            'type' => $this->resource->messageable_type === Group::class ? 'group' : 'direct',
        ];
    }
}
