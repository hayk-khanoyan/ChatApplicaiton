<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserChatResource;
use App\Models\Group;
use App\Models\UserChat;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserChatController extends Controller
{
    public function __construct(
        private GroupMessageController $groupMessageController,
        private DirectMessageController $directMessageController
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        $history = UserChat::query()
            ->withWhereHas('messageable')
            ->where('user_id', auth()->id())
            ->get();

        return UserChatResource::collection($history);
    }

    public function show(int $id): UserChatResource
    {
        $chat = UserChat::query()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return UserChatResource::make($chat);
    }

    public function chatMessages(int $id): ErrorResource|AnonymousResourceCollection
    {
        $chat = UserChat::query()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $chat->update([
            'last_delivery' => now(),
        ]);

        return Group::class === $chat->messageable_type
            ? $this->groupMessageController->index($chat->messageable_id)
            : $this->directMessageController->index($chat->messageable_id);
    }
}
