<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Group;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Group $resource
 */
class SearchResultResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'messageable_id' => $this->resource->id,
            'name' => $this->resource->name,
            'type' => $this->resource->type,
        ];
    }
}
