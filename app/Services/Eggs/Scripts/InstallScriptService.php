<?php

namespace SneakyPanel\Services\Eggs\Scripts;

use SneakyPanel\Models\Egg;
use SneakyPanel\Contracts\Repository\EggRepositoryInterface;
use SneakyPanel\Exceptions\Service\Egg\InvalidCopyFromException;

class InstallScriptService
{
    /**
     * InstallScriptService constructor.
     */
    public function __construct(protected EggRepositoryInterface $repository)
    {
    }

    /**
     * Modify the install script for a given Egg.
     *
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     * @throws \SneakyPanel\Exceptions\Repository\RecordNotFoundException
     * @throws \SneakyPanel\Exceptions\Service\Egg\InvalidCopyFromException
     */
    public function handle(Egg $egg, array $data): void
    {
        if (!is_null(array_get($data, 'copy_script_from'))) {
            if (!$this->repository->isCopyableScript(array_get($data, 'copy_script_from'), $egg->nest_id)) {
                throw new InvalidCopyFromException(trans('exceptions.nest.egg.invalid_copy_id'));
            }
        }

        $this->repository->withoutFreshModel()->update($egg->id, [
            'script_install' => array_get($data, 'script_install'),
            'script_is_privileged' => array_get($data, 'script_is_privileged', 1),
            'script_entry' => array_get($data, 'script_entry'),
            'script_container' => array_get($data, 'script_container'),
            'copy_script_from' => array_get($data, 'copy_script_from'),
        ]);
    }
}
