<?php

namespace SneakyPanel\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\VarDumper\VarDumper;
use SneakyPanel\Services\Telemetry\TelemetryCollectionService;

class TelemetryCommand extends Command
{
    protected $description = 'Displays all the data that would be sent to the SneakyPanel Telemetry Service if telemetry collection is enabled.';

    protected $signature = 'p:telemetry';

    /**
     * TelemetryCommand constructor.
     */
    public function __construct(private TelemetryCollectionService $telemetryCollectionService)
    {
        parent::__construct();
    }

    /**
     * Handle execution of command.
     *
     * @throws \SneakyPanel\Exceptions\Model\DataValidationException
     */
    public function handle()
    {
        $this->output->info('Collecting telemetry data, this may take a while...');

        VarDumper::dump($this->telemetryCollectionService->collect());
    }
}
