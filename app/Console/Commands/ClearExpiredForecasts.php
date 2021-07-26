<?php

namespace App\Console\Commands;

use App\Services\ForecastService;
use Illuminate\Console\Command;

class ClearExpiredForecasts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast:clear-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired forecasts.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected ForecastService $forecastService;

    public function __construct(ForecastService $forecastService)
    {
        $this->forecastService = $forecastService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->forecastService->deleteExpired();
    }
}
