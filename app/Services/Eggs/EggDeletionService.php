<?php

namespace SneakyPanel\Services\Eggs;

use SneakyPanel\Contracts\Repository\EggRepositoryInterface;
use SneakyPanel\Exceptions\Service\Egg\HasChildrenException;
use SneakyPanel\Exceptions\Service\HasActiveServersException;
use SneakyPanel\Contracts\Repository\ServerRepositoryInterface;

class EggDeletionService
{
    /**
     * EggDeletionService constructor.
     */
    public function __construct(
        protected ServerRepositoryInterface $serverRepository,
        protected EggRepositoryInterface $repository
    ) {
    }

    /**
     * Delete an Egg from the database if it has no active servers attached to it.
     *
     * @throws \SneakyPanel\Exceptions\Service\HasActiveServersException
     * @throws \SneakyPanel\Exceptions\Service\Egg\HasChildrenException
     */
    public function handle(int $egg): int
    {
        $servers = $this->serverRepository->findCountWhere([['egg_id', '=', $egg]]);
        if ($servers > 0) {
            throw new HasActiveServersException(trans('exceptions.nest.egg.delete_has_servers'));
        }

        $children = $this->repository->findCountWhere([['config_from', '=', $egg]]);
        if ($children > 0) {
            throw new HasChildrenException(trans('exceptions.nest.egg.has_children'));
        }

        return $this->repository->delete($egg);
    }
}
