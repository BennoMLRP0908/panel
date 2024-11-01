<?php

namespace SneakyPanel\Providers;

use SneakyPanel\Models\User;
use SneakyPanel\Models\Server;
use SneakyPanel\Models\Subuser;
use SneakyPanel\Models\EggVariable;
use SneakyPanel\Observers\UserObserver;
use SneakyPanel\Observers\ServerObserver;
use SneakyPanel\Observers\SubuserObserver;
use SneakyPanel\Observers\EggVariableObserver;
use SneakyPanel\Listeners\Auth\AuthenticationListener;
use SneakyPanel\Events\Server\Installed as ServerInstalledEvent;
use SneakyPanel\Notifications\ServerInstalled as ServerInstalledNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        ServerInstalledEvent::class => [ServerInstalledNotification::class],
    ];

    protected $subscribe = [
        AuthenticationListener::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        User::observe(UserObserver::class);
        Server::observe(ServerObserver::class);
        Subuser::observe(SubuserObserver::class);
        EggVariable::observe(EggVariableObserver::class);
    }
}
