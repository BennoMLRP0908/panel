<?php

namespace SneakyPanel\Services\Locations;

use SneakyPanel\Models\Location;
use SneakyPanel\Contracts\Repository\LocationRepositoryInterface;

class LocationCreationService
{
    /**
     * LocationCreationService constructor.
     */
    public function __construct(protected LocationRepositoryInterface $repository)
    {
    }

    /**
     * Create a new location.
     *
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     */
    public function handle(array $data): Location
    {
        return $this->repository->create($data);
    }
}
