<?php

namespace SneakyPanel\Events\Server;

use SneakyPanel\Events\Event;
use SneakyPanel\Models\Server;
use Illuminate\Queue\SerializesModels;

class Deleting extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Server $server)
    {
    }
}
