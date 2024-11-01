<?php

namespace SneakyPanel\Http\Requests\Api\Application\Nests;

use SneakyPanel\Services\Acl\Api\AdminAcl;
use SneakyPanel\Http\Requests\Api\Application\ApplicationApiRequest;

class GetNestsRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_NESTS;

    protected int $permission = AdminAcl::READ;
}
