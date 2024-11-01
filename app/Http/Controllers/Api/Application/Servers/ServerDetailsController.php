<?php

namespace SneakyPanel\Http\Controllers\Api\Application\Servers;

use SneakyPanel\Models\Server;
use SneakyPanel\Services\Servers\BuildModificationService;
use SneakyPanel\Services\Servers\DetailsModificationService;
use SneakyPanel\Transformers\Api\Application\ServerTransformer;
use SneakyPanel\Http\Controllers\Api\Application\ApplicationApiController;
use SneakyPanel\Http\Requests\Api\Application\Servers\UpdateServerDetailsRequest;
use SneakyPanel\Http\Requests\Api\Application\Servers\UpdateServerBuildConfigurationRequest;

class ServerDetailsController extends ApplicationApiController
{
    /**
     * ServerDetailsController constructor.
     */
    public function __construct(
        private BuildModificationService $buildModificationService,
        private DetailsModificationService $detailsModificationService
    ) {
        parent::__construct();
    }

    /**
     * Update the details for a specific server.
     *
     * @throws \SneakyPanel\Exceptions\DisplayException
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     * @throws \SneakyPanel\Exceptions\Repository\RecordNotFoundException
     */
    public function details(UpdateServerDetailsRequest $request, Server $server): array
    {
        $updated = $this->detailsModificationService->returnUpdatedModel()->handle(
            $server,
            $request->validated()
        );

        return $this->fractal->item($updated)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }

    /**
     * Update the build details for a specific server.
     *
     * @throws \SneakyPanel\Exceptions\DisplayException
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     * @throws \SneakyPanel\Exceptions\Repository\RecordNotFoundException
     */
    public function build(UpdateServerBuildConfigurationRequest $request, Server $server): array
    {
        $server = $this->buildModificationService->handle($server, $request->validated());

        return $this->fractal->item($server)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }
}
