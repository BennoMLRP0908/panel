<?php

namespace sneakypanel\Services\Allocations;

use sneakypanel\Models\Allocation;
use sneakypanel\Contracts\Repository\AllocationRepositoryInterface;
use sneakypanel\Exceptions\Service\Allocation\ServerUsingAllocationException;

class AllocationDeletionService
{
    /**
     * AllocationDeletionService constructor.
     */
    public function __construct(private AllocationRepositoryInterface $repository)
    {
    }

    /**
     * Delete an allocation from the database only if it does not have a server
     * that is actively attached to it.
     *
     * @throws ServerUsingAllocationException
     */
    public function handle(Allocation $allocation): int
    {
        if (!is_null($allocation->server_id)) {
            throw new ServerUsingAllocationException(trans('exceptions.allocations.server_using'));
        }

        return $this->repository->delete($allocation->id);
    }
}
