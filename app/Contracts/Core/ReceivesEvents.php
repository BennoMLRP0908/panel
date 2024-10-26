<?php

namespace sneakypanel\Contracts\Core;

use sneakypanel\Events\Event;

interface ReceivesEvents
{
    /**
     * Handles receiving an event from the application.
     */
    public function handle(Event $notification): void;
}
