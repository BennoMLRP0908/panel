<?php

namespace SneakyPanel\Providers;

use Illuminate\Support\ServiceProvider;
use SneakyPanel\Services\Activity\ActivityLogBatchService;
use SneakyPanel\Services\Activity\ActivityLogTargetableService;

class ActivityLogServiceProvider extends ServiceProvider
{
    /**
     * Registers the necessary activity logger singletons scoped to the individual
     * request instances.
     */
    public function register()
    {
        $this->app->scoped(ActivityLogBatchService::class);
        $this->app->scoped(ActivityLogTargetableService::class);
    }
}
