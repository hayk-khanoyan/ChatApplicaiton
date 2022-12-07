<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserSearchResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function search(Request $request): AnonymousResourceCollection|ErrorResource
    {
        if (!isset($request->search_query)) {
            return ErrorResource::make([
                'message' => "Query should not be empty!"
            ]);
        }

        $condition = "%" . $request->search_query . "%";

        $users = User::query()
            ->where('name', 'like', $condition)
            ->orWhere('email', 'like', $condition)
            ->paginate(50);


        return UserSearchResource::collection($users);
    }
}
