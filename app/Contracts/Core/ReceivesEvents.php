<?php

namespace SneakyPanel\Contracts\Core;

use SneakyPanel\Events\Event;

interface ReceivesEvents
{
    /**
     * Handles receiving an event from the application.
     */
    public function handle(Event $notification): void;
}
