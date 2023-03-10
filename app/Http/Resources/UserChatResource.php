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
        $groupIcon = "https://img.freepik.com/free-icon/multiple-users-silhouette_318-49546.jpg";

        return [
            'id' => $this->resource->id,
            'chat_title' => $this->resource->messageable->name,
            'chat_type' => $this->resource->messageable_type === Group::class ? 'group' : 'direct',
            'image_url' => $this->resource->messageable_type === Group::class ? $groupIcon : '',
            'display_message' => $this->resource->messageable->latestMessage?->message ?? '',
            'is_read' => $this->resource->last_delivery && $this->resource->last_delivery->greaterThanOrEqualTo($this->resource->updated_at)
        ];
    }
}
