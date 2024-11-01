<?php

namespace SneakyPanel\Services\Locations;

use SneakyPanel\Models\Location;
use SneakyPanel\Contracts\Repository\LocationRepositoryInterface;

class LocationUpdateService
{
    /**
     * LocationUpdateService constructor.
     */
    public function __construct(protected LocationRepositoryInterface $repository)
    {
    }

    /**
     * Update an existing location.
     *
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     * @throws \SneakyPanel\Exceptions\Repository\RecordNotFoundException
     */
    public function handle(Location|int $location, array $data): Location
    {
        $location = ($location instanceof Location) ? $location->id : $location;

        return $this->repository->update($location, $data);
    }
}
