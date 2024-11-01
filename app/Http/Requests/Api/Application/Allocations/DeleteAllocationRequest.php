<?php

namespace SneakyPanel\Http\Requests\Api\Application\Allocations;

use SneakyPanel\Services\Acl\Api\AdminAcl;
use SneakyPanel\Http\Requests\Api\Application\ApplicationApiRequest;

class DeleteAllocationRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_ALLOCATIONS;

    protected int $permission = AdminAcl::WRITE;
}
