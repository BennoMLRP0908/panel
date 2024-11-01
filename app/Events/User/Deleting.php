<?php

namespace SneakyPanel\Events\User;

use SneakyPanel\Models\User;
use SneakyPanel\Events\Event;
use Illuminate\Queue\SerializesModels;

class Deleting extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public User $user)
    {
    }
}
