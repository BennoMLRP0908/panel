<?php

namespace SneakyPanel\Providers;

use Illuminate\Support\ServiceProvider;
use SneakyPanel\Repositories\Eloquent\EggRepository;
use SneakyPanel\Repositories\Eloquent\NestRepository;
use SneakyPanel\Repositories\Eloquent\NodeRepository;
use SneakyPanel\Repositories\Eloquent\TaskRepository;
use SneakyPanel\Repositories\Eloquent\UserRepository;
use SneakyPanel\Repositories\Eloquent\ApiKeyRepository;
use SneakyPanel\Repositories\Eloquent\ServerRepository;
use SneakyPanel\Repositories\Eloquent\SessionRepository;
use SneakyPanel\Repositories\Eloquent\SubuserRepository;
use SneakyPanel\Repositories\Eloquent\DatabaseRepository;
use SneakyPanel\Repositories\Eloquent\LocationRepository;
use SneakyPanel\Repositories\Eloquent\ScheduleRepository;
use SneakyPanel\Repositories\Eloquent\SettingsRepository;
use SneakyPanel\Repositories\Eloquent\AllocationRepository;
use SneakyPanel\Contracts\Repository\EggRepositoryInterface;
use SneakyPanel\Repositories\Eloquent\EggVariableRepository;
use SneakyPanel\Contracts\Repository\NestRepositoryInterface;
use SneakyPanel\Contracts\Repository\NodeRepositoryInterface;
use SneakyPanel\Contracts\Repository\TaskRepositoryInterface;
use SneakyPanel\Contracts\Repository\UserRepositoryInterface;
use SneakyPanel\Repositories\Eloquent\DatabaseHostRepository;
use SneakyPanel\Contracts\Repository\ApiKeyRepositoryInterface;
use SneakyPanel\Contracts\Repository\ServerRepositoryInterface;
use SneakyPanel\Repositories\Eloquent\ServerVariableRepository;
use SneakyPanel\Contracts\Repository\SessionRepositoryInterface;
use SneakyPanel\Contracts\Repository\SubuserRepositoryInterface;
use SneakyPanel\Contracts\Repository\DatabaseRepositoryInterface;
use SneakyPanel\Contracts\Repository\LocationRepositoryInterface;
use SneakyPanel\Contracts\Repository\ScheduleRepositoryInterface;
use SneakyPanel\Contracts\Repository\SettingsRepositoryInterface;
use SneakyPanel\Contracts\Repository\AllocationRepositoryInterface;
use SneakyPanel\Contracts\Repository\EggVariableRepositoryInterface;
use SneakyPanel\Contracts\Repository\DatabaseHostRepositoryInterface;
use SneakyPanel\Contracts\Repository\ServerVariableRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register all the repository bindings.
     */
    public function register(): void
    {
        // Eloquent Repositories
        $this->app->bind(AllocationRepositoryInterface::class, AllocationRepository::class);
        $this->app->bind(ApiKeyRepositoryInterface::class, ApiKeyRepository::class);
        $this->app->bind(DatabaseRepositoryInterface::class, DatabaseRepository::class);
        $this->app->bind(DatabaseHostRepositoryInterface::class, DatabaseHostRepository::class);
        $this->app->bind(EggRepositoryInterface::class, EggRepository::class);
        $this->app->bind(EggVariableRepositoryInterface::class, EggVariableRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(NestRepositoryInterface::class, NestRepository::class);
        $this->app->bind(NodeRepositoryInterface::class, NodeRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(ServerRepositoryInterface::class, ServerRepository::class);
        $this->app->bind(ServerVariableRepositoryInterface::class, ServerVariableRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(SubuserRepositoryInterface::class, SubuserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
