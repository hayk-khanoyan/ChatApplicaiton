<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\DirectMessageSend;
use App\Http\Requests\StoreUserMessageRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserMessageResource;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DirectMessageController extends Controller
{
    public function index(int $senderId): AnonymousResourceCollection
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        $messages = UserMessage::query()
            ->with('sender')
            ->where(function ($query) use ($user, $senderId): void {
                $query->where('receiver_id', $user->id);
                $query->where('sender_id', $senderId);
            })
            ->orWhere(function ($query) use ($user, $senderId): void {
                $query->where('receiver_id', $senderId);
                $query->where('sender_id', $user->id);
            })
            ->latest()
            ->cursorPaginate(50);

        return UserMessageResource::collection($messages);
    }

    public function store(int $userId, StoreUserMessageRequest $request): SuccessResource
    {
        $validated = $request->validated();

        /**
         * @var User $sender
         */
        $sender = auth()->user();

        /**
         * @var User $receiver
         */
        $receiver = User::query()->findOrFail($userId);

        $validated['sender_id'] = $sender->id;

        $message = $receiver->messages()
            ->create($validated);

        DirectMessageSend::dispatch($receiver, $sender);

        return SuccessResource::make([
            'data' => UserMessageResource::make($message),
            'message' => 'Message posted successfully.',
        ]);
    }
}
