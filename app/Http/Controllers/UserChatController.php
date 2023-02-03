<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserChatResource;
use App\Models\UserChat;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserChatController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $history = UserChat::query()
            ->withWhereHas('messageable')
            ->where('user_id', auth()->id())
            ->get();

        return UserChatResource::collection($history);
    }
}
