<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageHistoryResource;
use App\Models\MessageHistory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MessageHistoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $history = MessageHistory::query()
            ->withWhereHas('messageable')
            ->where('user_id', auth()->id())
            ->get();

        return MessageHistoryResource::collection($history);
    }
}
