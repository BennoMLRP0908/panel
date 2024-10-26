<?php

namespace sneakypanel\Http\Requests\Api\Application\Locations;

use sneakypanel\Services\Acl\Api\AdminAcl;
use sneakypanel\Http\Requests\Api\Application\ApplicationApiRequest;

class GetLocationsRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_LOCATIONS;

    protected int $permission = AdminAcl::READ;
}
