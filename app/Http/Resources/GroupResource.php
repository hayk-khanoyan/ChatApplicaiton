<?php

namespace App\Http\Resources;

use App\Models\Group;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Group resource */
class GroupResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'participants' => $this->resource->participants_count,
        ];
    }
}
