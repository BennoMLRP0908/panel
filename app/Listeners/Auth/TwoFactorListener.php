<?php

namespace sneakypanel\Listeners\Auth;

use sneakypanel\Facades\Activity;
use sneakypanel\Events\Auth\ProvidedAuthenticationToken;

class TwoFactorListener
{
    public function handle(ProvidedAuthenticationToken $event): void
    {
        Activity::event($event->recovery ? 'auth:recovery-token' : 'auth:token')
            ->withRequestMetadata()
            ->subject($event->user)
            ->log();
    }
}
