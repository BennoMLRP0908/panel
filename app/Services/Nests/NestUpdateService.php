<?php

namespace SneakyPanel\Services\Nests;

use SneakyPanel\Contracts\Repository\NestRepositoryInterface;

class NestUpdateService
{
    /**
     * NestUpdateService constructor.
     */
    public function __construct(protected NestRepositoryInterface $repository)
    {
    }

    /**
     * Update a nest and prevent changing the author once it is set.
     *
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     * @throws \SneakyPanel\Exceptions\Repository\RecordNotFoundException
     */
    public function handle(int $nest, array $data): void
    {
        if (!is_null(array_get($data, 'author'))) {
            unset($data['author']);
        }

        $this->repository->withoutFreshModel()->update($nest, $data);
    }
}
