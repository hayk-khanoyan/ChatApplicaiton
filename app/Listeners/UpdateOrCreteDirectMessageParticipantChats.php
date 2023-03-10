<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\DirectMessageSend;

class UpdateOrCreteDirectMessageParticipantChats
{
    public function handle(DirectMessageSend $event): void
    {
        $event->receiver->chat()->updateOrCreate(['user_id' => $event->sender->id], [
            'updated_at' => now(),
        ]);

        $event->sender->chat()->updateOrCreate(['user_id' => $event->receiver->id], [
            'updated_at' => now(),
        ]);
    }
}
