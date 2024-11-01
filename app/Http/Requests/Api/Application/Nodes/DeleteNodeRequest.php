<?php

namespace SneakyPanel\Http\Requests\Api\Application\Nodes;

use SneakyPanel\Services\Acl\Api\AdminAcl;
use SneakyPanel\Http\Requests\Api\Application\ApplicationApiRequest;

class DeleteNodeRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_NODES;

    protected int $permission = AdminAcl::WRITE;
}
