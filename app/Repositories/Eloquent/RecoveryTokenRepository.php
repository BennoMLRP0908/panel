<?php

namespace SneakyPanel\Repositories\Eloquent;

use SneakyPanel\Models\RecoveryToken;

class RecoveryTokenRepository extends EloquentRepository
{
    public function model(): string
    {
        return RecoveryToken::class;
    }
}
