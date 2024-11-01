<?php

namespace SneakyPanel\Repositories\Eloquent;

use SneakyPanel\Models\ServerVariable;
use SneakyPanel\Contracts\Repository\ServerVariableRepositoryInterface;

class ServerVariableRepository extends EloquentRepository implements ServerVariableRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return ServerVariable::class;
    }
}
