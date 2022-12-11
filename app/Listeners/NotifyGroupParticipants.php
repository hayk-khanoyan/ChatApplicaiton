<?php

namespace App\Listeners;

use App\Models\Group;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyGroupParticipants implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {
        /** @var Group $group */
        $group = $event->group;

        $participants = $group->participants()->get();

        foreach ($participants as $participant) {
            $group->history()->updateOrCreate(['user_id' => $participant->user_id], ['updated_at' => now()]);
        }
    }
}
