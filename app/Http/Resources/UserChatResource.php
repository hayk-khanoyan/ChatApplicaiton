<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\UserChat;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property UserChat $resource
 */
class UserChatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'messageable_id' => $this->resource->messageable->id,
            'name' => $this->resource->messageable->name,
            'type' => $this->resource->messageable_type === Group::class ? 'group' : 'direct',
        ];
    }
}