<?php

namespace SneakyPanel\Events\Subuser;

use SneakyPanel\Events\Event;
use SneakyPanel\Models\Subuser;
use Illuminate\Queue\SerializesModels;

class Deleted extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Subuser $subuser)
    {
    }
}
