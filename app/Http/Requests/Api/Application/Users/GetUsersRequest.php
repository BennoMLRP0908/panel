<?php

namespace SneakyPanel\Http\Requests\Api\Application\Users;

use SneakyPanel\Services\Acl\Api\AdminAcl as Acl;
use SneakyPanel\Http\Requests\Api\Application\ApplicationApiRequest;

class GetUsersRequest extends ApplicationApiRequest
{
    protected ?string $resource = Acl::RESOURCE_USERS;

    protected int $permission = Acl::READ;
}
