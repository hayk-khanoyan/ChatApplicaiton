<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Models\Hobby;

class UserHobbyController extends Controller
{
    public function index(): SuccessResource
    {
        $hobbies = Hobby::query()->where('user_id', auth()->id())->get();

        return SuccessResource::make([
            'data' => $hobbies
        ]);
    }

    public function store()
    {

    }
}
