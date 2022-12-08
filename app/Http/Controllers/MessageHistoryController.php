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
}
