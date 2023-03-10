<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupParticipantController extends Controller
{
    public function index(int $groupId): AnonymousResourceCollection
    {
        /** @var Group $group */
        $group = Group::query()->findOrFail($groupId);

        $participants = $group->participants()->get();

        return UserResource::collection($participants);
    }

    public function store(int $groupId, Request $request): SuccessResource
    {
        $validated = $request->all();

        /** @var Group $group */
        $group = Group::query()->findOrFail($groupId);

        $participant = $group->participants()->updateOrCreate([
            'user_id' => $validated['user_id'],
        ]);

        return SuccessResource::make([
            'data' => UserResource::make($participant),
            'message' => 'Participant added successfully.',
        ]);
    }
}
