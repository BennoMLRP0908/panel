<?php

namespace SneakyPanel\Http\Requests\Api\Application\Users;

use SneakyPanel\Services\Acl\Api\AdminAcl;
use SneakyPanel\Http\Requests\Api\Application\ApplicationApiRequest;

class DeleteUserRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_USERS;

    protected int $permission = AdminAcl::WRITE;
}
