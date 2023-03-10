<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\DirectMessageSend;
use App\Events\GroupMessageSend;
use App\Listeners\NotifyGroupParticipants;
use App\Listeners\UpdateOrCreteDirectMessageParticipantChats;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        GroupMessageSend::class => [
            NotifyGroupParticipants::class,
        ],
        DirectMessageSend::class => [
            UpdateOrCreteDirectMessageParticipantChats::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
