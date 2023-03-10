<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Models\Hobby;

class HobbyController extends Controller
{
    public function __invoke(): SuccessResource
    {
        $hobbies = Hobby::all();

        return SuccessResource::make([
            'data' => $hobbies,
        ]);
    }
}
