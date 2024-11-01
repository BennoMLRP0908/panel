<?php

namespace SneakyPanel\Facades;

use Illuminate\Support\Facades\Facade;
use SneakyPanel\Services\Activity\ActivityLogBatchService;

class LogBatch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogBatchService::class;
    }
}
