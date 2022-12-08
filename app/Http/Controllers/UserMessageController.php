<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserMessageRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserMessageResource;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserMessageController extends Controller
{
    public function index(int $senderId): AnonymousResourceCollection
    {
        $user = auth()->user();

        $messages = UserMessage::query()
            ->with('sender')
            ->where('receiver_id', $user->id)
            ->where('sender_id', $senderId)
            ->cursorPaginate(50);

        return UserMessageResource::collection($messages);
    }

    public function store(int $userId, StoreUserMessageRequest $request): SuccessResource
    {
        $validated = $request->validated();

        $sender = auth()->user();

        $receiver = User::query()->findOrFail($userId);

        $validated['sender_id'] = $sender->id;

        $message = $receiver->messages()
            ->create($validated);

        $receiver->history()->updateOrCreate(['user_id' => $sender->id], [
            'updated_at' => now(),
        ]);

        $sender->history()->updateOrCreate(['user_id' => $receiver->id], [
            'updated_at' => now(),
        ]);

        return SuccessResource::make([
            'data' => UserMessageResource::make($message),
            'message' => 'Message posted successfully.'
        ]);
    }
}
