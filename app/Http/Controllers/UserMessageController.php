<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserMessageRequest;
use App\Http\Resources\GroupMessageResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserMessageResource;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserMessageController extends Controller
{
    public function index(int $senderId): AnonymousResourceCollection
    {
        $user = auth()->user();

        $messages = UserMessage::query()
            ->where('reciever_id', $user->id)
            ->where('sender_id', $senderId)
            ->cursorPaginate(500);

        return UserMessageResource::collection($messages);
    }

    public function store(int $userId, StoreUserMessageRequest $request)
    {
        $validated = $request->validated();

        $validated['sender_id'] = auth()->id();

        $user = User::query()->findOrFail($userId);

        $message = $user->messages()
            ->create($validated);

        $user->history()->updateOrCreate(['user_id' => auth()->id()], [
            'updated_at' => now(),
        ]);

        return SuccessResource::make([
            'data' => UserMessageResource::make($message),
            'message' => 'Message posted successfully.'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
