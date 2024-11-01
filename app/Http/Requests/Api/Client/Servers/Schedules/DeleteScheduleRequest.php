<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Schedules;

use SneakyPanel\Models\Permission;

class DeleteScheduleRequest extends ViewScheduleRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SCHEDULE_DELETE;
    }
}
