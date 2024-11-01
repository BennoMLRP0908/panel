<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Databases;

use SneakyPanel\Models\Permission;
use SneakyPanel\Contracts\Http\ClientPermissionsRequest;
use SneakyPanel\Http\Requests\Api\Client\ClientApiRequest;

class GetDatabasesRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_DATABASE_READ;
    }
}
