<?php

namespace SneakyPanel\Events\Auth;

use SneakyPanel\Models\User;
use SneakyPanel\Events\Event;

class ProvidedAuthenticationToken extends Event
{
    public function __construct(public User $user, public bool $recovery = false)
    {
    }
}
