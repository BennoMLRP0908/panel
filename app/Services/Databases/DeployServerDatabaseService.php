<?php

namespace SneakyPanel\Services\Databases;

use Webmozart\Assert\Assert;
use SneakyPanel\Models\Server;
use SneakyPanel\Models\Database;
use SneakyPanel\Models\DatabaseHost;
use SneakyPanel\Exceptions\Service\Database\NoSuitableDatabaseHostException;

class DeployServerDatabaseService
{
    /**
     * DeployServerDatabaseService constructor.
     */
    public function __construct(private DatabaseManagementService $managementService)
    {
    }

    /**
     * @throws \Throwable
     * @throws \SneakyPanel\Exceptions\Service\Database\TooManyDatabasesException
     * @throws \SneakyPanel\Exceptions\Service\Database\DatabaseClientFeatureNotEnabledException
     */
    public function handle(Server $server, array $data): Database
    {
        Assert::notEmpty($data['database'] ?? null);
        Assert::notEmpty($data['remote'] ?? null);

        $hosts = DatabaseHost::query()->get()->toBase();
        if ($hosts->isEmpty()) {
            throw new NoSuitableDatabaseHostException();
        } else {
            $nodeHosts = $hosts->where('node_id', $server->node_id)->toBase();

            if ($nodeHosts->isEmpty() && !config('sneakypanel.client_features.databases.allow_random')) {
                throw new NoSuitableDatabaseHostException();
            }
        }

        return $this->managementService->create($server, [
            'database_host_id' => $nodeHosts->isEmpty()
                ? $hosts->random()->id
                : $nodeHosts->random()->id,
            'database' => DatabaseManagementService::generateUniqueDatabaseName($data['database'], $server->id),
            'remote' => $data['remote'],
        ]);
    }
}
