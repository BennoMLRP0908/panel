<?php

namespace SneakyPanel\Http\Controllers\Api\Client\Servers;

use Illuminate\Http\Response;
use SneakyPanel\Models\Server;
use SneakyPanel\Models\Database;
use SneakyPanel\Facades\Activity;
use SneakyPanel\Services\Databases\DatabasePasswordService;
use SneakyPanel\Transformers\Api\Client\DatabaseTransformer;
use SneakyPanel\Services\Databases\DatabaseManagementService;
use SneakyPanel\Services\Databases\DeployServerDatabaseService;
use SneakyPanel\Http\Controllers\Api\Client\ClientApiController;
use SneakyPanel\Http\Requests\Api\Client\Servers\Databases\GetDatabasesRequest;
use SneakyPanel\Http\Requests\Api\Client\Servers\Databases\StoreDatabaseRequest;
use SneakyPanel\Http\Requests\Api\Client\Servers\Databases\DeleteDatabaseRequest;
use SneakyPanel\Http\Requests\Api\Client\Servers\Databases\RotatePasswordRequest;

class DatabaseController extends ClientApiController
{
    /**
     * DatabaseController constructor.
     */
    public function __construct(
        private DeployServerDatabaseService $deployDatabaseService,
        private DatabaseManagementService $managementService,
        private DatabasePasswordService $passwordService
    ) {
        parent::__construct();
    }

    /**
     * Return all the databases that belong to the given server.
     */
    public function index(GetDatabasesRequest $request, Server $server): array
    {
        return $this->fractal->collection($server->databases)
            ->transformWith($this->getTransformer(DatabaseTransformer::class))
            ->toArray();
    }

    /**
     * Create a new database for the given server and return it.
     *
     * @throws \Throwable
     * @throws \SneakyPanel\Exceptions\Service\Database\TooManyDatabasesException
     * @throws \SneakyPanel\Exceptions\Service\Database\DatabaseClientFeatureNotEnabledException
     */
    public function store(StoreDatabaseRequest $request, Server $server): array
    {
        $database = $this->deployDatabaseService->handle($server, $request->validated());

        Activity::event('server:database.create')
            ->subject($database)
            ->property('name', $database->database)
            ->log();

        return $this->fractal->item($database)
            ->parseIncludes(['password'])
            ->transformWith($this->getTransformer(DatabaseTransformer::class))
            ->toArray();
    }

    /**
     * Rotates the password for the given server model and returns a fresh instance to
     * the caller.
     *
     * @throws \Throwable
     */
    public function rotatePassword(RotatePasswordRequest $request, Server $server, Database $database): array
    {
        $this->passwordService->handle($database);
        $database->refresh();

        Activity::event('server:database.rotate-password')
            ->subject($database)
            ->property('name', $database->database)
            ->log();

        return $this->fractal->item($database)
            ->parseIncludes(['password'])
            ->transformWith($this->getTransformer(DatabaseTransformer::class))
            ->toArray();
    }

    /**
     * Removes a database from the server.
     *
     * @throws \SneakyPanel\Exceptions\Repository\RecordNotFoundException
     */
    public function delete(DeleteDatabaseRequest $request, Server $server, Database $database): Response
    {
        $this->managementService->delete($database);

        Activity::event('server:database.delete')
            ->subject($database)
            ->property('name', $database->database)
            ->log();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
