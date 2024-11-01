<?php

namespace SneakyPanel\Http\Controllers\Api\Application\Servers;

use SneakyPanel\Models\User;
use SneakyPanel\Models\Server;
use SneakyPanel\Services\Servers\StartupModificationService;
use SneakyPanel\Transformers\Api\Application\ServerTransformer;
use SneakyPanel\Http\Controllers\Api\Application\ApplicationApiController;
use SneakyPanel\Http\Requests\Api\Application\Servers\UpdateServerStartupRequest;

class StartupController extends ApplicationApiController
{
    /**
     * StartupController constructor.
     */
    public function __construct(private StartupModificationService $modificationService)
    {
        parent::__construct();
    }

    /**
     * Update the startup and environment settings for a specific server.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \SneakyPanel\Exceptions\Http\Connection\DaemonConnectionException
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     * @throws \SneakyPanel\Exceptions\Repository\RecordNotFoundException
     */
    public function index(UpdateServerStartupRequest $request, Server $server): array
    {
        $server = $this->modificationService
            ->setUserLevel(User::USER_LEVEL_ADMIN)
            ->handle($server, $request->validated());

        return $this->fractal->item($server)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }
}
