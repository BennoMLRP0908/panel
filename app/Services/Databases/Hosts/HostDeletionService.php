<?php

namespace sneakypanel\Services\Databases\Hosts;

use sneakypanel\Exceptions\Service\HasActiveServersException;
use sneakypanel\Contracts\Repository\DatabaseRepositoryInterface;
use sneakypanel\Contracts\Repository\DatabaseHostRepositoryInterface;

class HostDeletionService
{
    /**
     * HostDeletionService constructor.
     */
    public function __construct(
        private DatabaseRepositoryInterface $databaseRepository,
        private DatabaseHostRepositoryInterface $repository,
    ) {
    }

    /**
     * Delete a specified host from the Panel if no databases are
     * attached to it.
     *
     * @throws HasActiveServersException
     */
    public function handle(int $host): int
    {
        $count = $this->databaseRepository->findCountWhere([['database_host_id', '=', $host]]);
        if ($count > 0) {
            throw new HasActiveServersException(trans('exceptions.databases.delete_has_databases'));
        }

        return $this->repository->delete($host);
    }
}
