<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Schedules;

use SneakyPanel\Models\Permission;

class UpdateScheduleRequest extends StoreScheduleRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SCHEDULE_UPDATE;
    }
}
