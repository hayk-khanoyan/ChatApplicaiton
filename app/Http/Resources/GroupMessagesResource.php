<?php

namespace App\Http\Resources;

use App\Models\GroupMessage;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property GroupMessage resource */
class GroupMessagesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'participants' => $this->resource->participants_count,
        ];
    }
}
