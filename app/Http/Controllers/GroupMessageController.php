<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupMessageRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\GroupMessageResource;
use App\Http\Resources\SuccessResource;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupMessageController extends Controller
{
    public function index(int $groupId): AnonymousResourceCollection|ErrorResource
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->isParticipantOn($groupId)) {
            return ErrorResource::make([
                'message' => 'Access denied.'
            ]);
        }

        $messages = GroupMessage::query()
            ->with('sender')
            ->where('group_id', $groupId)
            ->cursorPaginate(50);

        return GroupMessageResource::collection($messages);
    }

    public function store(int $groupId, StoreGroupMessageRequest $request): SuccessResource
    {
        $validated = $request->validated();

        $validated['sender_id'] = auth()->id();

        $group = Group::query()->findOrFail($groupId);

        $message = $group->messages()
            ->create($validated);

        $group->history()->updateOrCreate(['user_id' => auth()->id()], [
            'updated_at' => now(),
        ]);

        return SuccessResource::make([
            'data' => GroupMessageResource::make($message),
            'message' => 'Message posted successfully.'
        ]);
    }
}
