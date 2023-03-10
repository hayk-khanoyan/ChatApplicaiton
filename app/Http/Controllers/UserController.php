<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function show(): UserResource
    {
        $user = auth()->user();

        return UserResource::make($user);
    }
}
