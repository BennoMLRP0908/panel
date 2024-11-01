<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Settings;

use SneakyPanel\Models\Permission;
use SneakyPanel\Http\Requests\Api\Client\ClientApiRequest;

class ReinstallServerRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SETTINGS_REINSTALL;
    }
}
