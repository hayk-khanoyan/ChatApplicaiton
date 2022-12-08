<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSearchRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserSearchController extends Controller
{
    public function search(UserSearchRequest $request): AnonymousResourceCollection|ErrorResource
    {
        $validated = $request->validated();

        $condition = "%" . $validated['search_query'] . "%";

        $users = User::query()
            ->where('name', 'like', $condition)
            ->orWhere('email', 'like', $condition)
            ->paginate(50);


        return UserResource::collection($users);
    }
}
