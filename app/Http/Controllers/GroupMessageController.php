<?php

namespace App\Http\Controllers;

use App\Events\GroupMessageSend;
use App\Http\Requests\StoreGroupMessageRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\GroupMessageResource;
use App\Http\Resources\SuccessResource;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupMessageController extends Controller
{
    public function index(int $groupId): AnonymousResourceCollection|ErrorResource
    {
        /** @var User $user */
        $user = auth()->user();

        $group = Group::query()->findOrFail($groupId);

        $isParticipateOnGroup = $user->isParticipantOn($groupId);

        if ($group->type === 'public' && !$isParticipateOnGroup) {
            $group->participants()->create([
                'user_id' => $user->id
            ]);

            $isParticipateOnGroup = true;
        }


        if (!$isParticipateOnGroup) {
            return ErrorResource::make([
                'message' => 'Access denied.'
            ]);
        }

        $messages = GroupMessage::query()
            ->with('sender')
            ->where('group_id', $groupId)
            ->latest()
            ->cursorPaginate(50);

        return GroupMessageResource::collection($messages);
    }

    public function store(int $groupId, StoreGroupMessageRequest $request): SuccessResource|ErrorResource
    {
        /** @var User $user */
        $user = auth()->user();

        $group = Group::query()->findOrFail($groupId);

        $isParticipateOnGroup = $user->isParticipantOn($groupId);

        if (!$isParticipateOnGroup) {
            return ErrorResource::make([
                'message' => 'Access denied.'
            ]);
        }

        $validated = $request->validated();

        $validated['sender_id'] = $user->id;

        $message = $group->messages()
            ->create($validated);

        GroupMessageSend::dispatch($group);

        return SuccessResource::make([
            'data' => GroupMessageResource::make($message),
            'message' => 'Message posted successfully.'
        ]);
    }
}
