<?php

namespace App\Events;

use App\Models\Group;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupMessageSend
{
    use Dispatchable, SerializesModels;

    public function __construct(public Group $group)
    {
    }
}
