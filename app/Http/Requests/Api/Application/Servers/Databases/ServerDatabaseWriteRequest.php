<?php

namespace SneakyPanel\Http\Requests\Api\Application\Servers\Databases;

use SneakyPanel\Services\Acl\Api\AdminAcl;

class ServerDatabaseWriteRequest extends GetServerDatabasesRequest
{
    protected int $permission = AdminAcl::WRITE;
}
