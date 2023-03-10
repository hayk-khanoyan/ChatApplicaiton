<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\GroupMessageSend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyGroupParticipants implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(GroupMessageSend $event): void
    {
        $group = $event->group;

        $participants = $group->participants()->get();

        foreach ($participants as $participant) {
            $group->history()->updateOrCreate(['user_id' => $participant->user_id], ['updated_at' => now()]);
        }
    }
}
