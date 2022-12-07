<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupParticipant;
use Illuminate\Http\Request;

class GroupParticipantController extends Controller
{
    public function store(int $groupId, Request $request)
    {
        $group = Group::query()->findOrFail($groupId);

        $group->participants()->updateOrCreate([
            'user_id' => $request->user_id
        ]);
    }


    public function show(GroupParticipant $groupParticipants)
    {
        //
    }

    public function edit(GroupParticipant $groupParticipants)
    {
        //
    }

    public function update(Request $request, GroupParticipant $groupParticipants)
    {
        //
    }


    public function destroy(GroupParticipant $groupParticipants)
    {
        //
    }
}
