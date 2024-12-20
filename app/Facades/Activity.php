<?php

namespace SneakyPanel\Facades;

use Illuminate\Support\Facades\Facade;
use SneakyPanel\Services\Activity\ActivityLogService;

class Activity extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogService::class;
    }
}
