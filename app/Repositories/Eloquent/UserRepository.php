<?php

namespace SneakyPanel\Repositories\Eloquent;

use SneakyPanel\Models\User;
use SneakyPanel\Contracts\Repository\UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return User::class;
    }
}
