<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageHistoryResource;
use App\Models\Group;
use App\Models\UserMessage;
use App\Models\UserMessageHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MessageHistoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $history = UserMessageHistory::query()
            ->withWhereHas('messageable')
            ->where('user_id', auth()->id())
            ->get();

        return MessageHistoryResource::collection($history);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
