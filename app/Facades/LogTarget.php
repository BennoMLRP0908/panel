<?php

namespace SneakyPanel\Facades;

use Illuminate\Support\Facades\Facade;
use SneakyPanel\Services\Activity\ActivityLogTargetableService;

class LogTarget extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogTargetableService::class;
    }
}
