<?php

namespace SneakyPanel\Http\Controllers\Api\Application\Users;

use SneakyPanel\Models\User;
use SneakyPanel\Transformers\Api\Application\UserTransformer;
use SneakyPanel\Http\Controllers\Api\Application\ApplicationApiController;
use SneakyPanel\Http\Requests\Api\Application\Users\GetExternalUserRequest;

class ExternalUserController extends ApplicationApiController
{
    /**
     * Retrieve a specific user from the database using their external ID.
     */
    public function index(GetExternalUserRequest $request, string $external_id): array
    {
        $user = User::query()->where('external_id', $external_id)->firstOrFail();

        return $this->fractal->item($user)
            ->transformWith($this->getTransformer(UserTransformer::class))
            ->toArray();
    }
}
