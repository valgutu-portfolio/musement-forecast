<?php

namespace App\Console\Commands;

use App\Services\CityService;
use App\Services\ForecastService;
use Illuminate\Console\Command;

class ForecastUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cities and get forecast.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected CityService $cityService;
    protected ForecastService $forecastService;

    public function __construct(CityService $cityService, ForecastService $forecastService)
    {
        parent::__construct();

        $this->cityService = $cityService;
        $this->forecastService = $forecastService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->cityService->updateAll();
        $this->forecastService->updateExpiredForecast();
    }
}
