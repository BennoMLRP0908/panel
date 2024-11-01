<?php

namespace SneakyPanel\Extensions\Laravel\Sanctum;

use SneakyPanel\Models\ApiKey;
use Laravel\Sanctum\NewAccessToken as SanctumAccessToken;

/**
 * @property \SneakyPanel\Models\ApiKey $accessToken
 */
class NewAccessToken extends SanctumAccessToken
{
    /**
     * NewAccessToken constructor.
     *
     * @noinspection PhpMissingParentConstructorInspection
     */
    public function __construct(ApiKey $accessToken, string $plainTextToken)
    {
        $this->accessToken = $accessToken;
        $this->plainTextToken = $plainTextToken;
    }
}
