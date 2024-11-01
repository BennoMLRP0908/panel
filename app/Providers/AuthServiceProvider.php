<?php

namespace SneakyPanel\Providers;

use Laravel\Sanctum\Sanctum;
use SneakyPanel\Models\ApiKey;
use SneakyPanel\Models\Server;
use SneakyPanel\Policies\ServerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     */
    protected $policies = [
        Server::class => ServerPolicy::class,
    ];

    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(ApiKey::class);
    }

    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }
}
