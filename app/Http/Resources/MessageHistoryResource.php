<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\UserMessageHistory;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property UserMessageHistory $resource
 */
class MessageHistoryResource extends JsonResource
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
