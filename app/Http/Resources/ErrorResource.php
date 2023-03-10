<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public function withResponse($request, $response): void
    {
        $response->setStatusCode(403);
    }

    public function toArray($request)
    {
        self::withoutWrapping();

        return parent::toArray($request);
    }
}
