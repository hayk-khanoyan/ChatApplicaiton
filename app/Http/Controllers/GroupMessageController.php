<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupMessageRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\GroupMessageResource;
use App\Http\Resources\SuccessResource;
use App\Models\Group;
use App\Models\GroupMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupMessageController extends Controller
{
    public function index(int $groupId): AnonymousResourceCollection|ErrorResource
    {
        $user = auth()->user();

        if (!$user->isParticipantOn($groupId)) {
            return ErrorResource::make([
                'message' => 'Access denied.'
            ]);
        }

        $messages = GroupMessage::query()
            ->with('sender')
            ->where('group_id', $groupId)
            ->cursorPaginate(500);

        return GroupMessageResource::collection($messages);
    }

    public function store(int $groupId, StoreGroupMessageRequest $request): SuccessResource
    {
        $validated = $request->validated();

        $validated['sender_id'] = auth()->id();

        $group = Group::query()->findOrFail($groupId);

        $message = $group->messages()
            ->create($validated);

        return SuccessResource::make([
            'data' => GroupMessageResource::make($message),
            'message' => 'Message posted successfully.'
        ]);
    }

    public function show(GroupMessage $message)
    {
        //
    }

    public function edit(GroupMessage $message)
    {
        //
    }

    public function update(Request $request, GroupMessage $message)
    {
        //
    }

    public function destroy(GroupMessage $message)
    {
        //
    }
}
