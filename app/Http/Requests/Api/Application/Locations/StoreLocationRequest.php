<?php

namespace SneakyPanel\Http\Requests\Api\Application\Locations;

use SneakyPanel\Models\Location;
use SneakyPanel\Services\Acl\Api\AdminAcl;
use SneakyPanel\Http\Requests\Api\Application\ApplicationApiRequest;

class StoreLocationRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_LOCATIONS;

    protected int $permission = AdminAcl::WRITE;

    /**
     * Rules to validate the request against.
     */
    public function rules(): array
    {
        return collect(Location::getRules())->only([
            'long',
            'short',
        ])->toArray();
    }

    /**
     * Rename fields to be more clear in error messages.
     */
    public function attributes(): array
    {
        return [
            'long' => 'Location Description',
            'short' => 'Location Identifier',
        ];
    }
}
