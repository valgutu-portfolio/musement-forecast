<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use App\Services\ForecastService;
use Carbon\Carbon;

class ForecastController extends Controller
{
    protected ForecastService $forecastService;
    protected CityService $cityService;

    public function __construct(ForecastService $forecastService, CityService $cityService)
    {
        $this->forecastService = $forecastService;
        $this->cityService = $cityService;
    }

    public function updateAll()
    {
        $this->forecastService->updateExpiredForecast();
    }

    public function showAllCitiesForecast()
    {
        $cities = $this->cityService->allWithForecast();

        $forecast = [];

        foreach ($cities as $city) {
            try {
                $cityForecast = $city->forecast;
                $today = $cityForecast->where('date', Carbon::today()->format('Y-m-d'))->first();
                $tomorrow = $cityForecast->where('date', Carbon::tomorrow()->format('Y-m-d'))->first();

                $forecast[] = "<div class='text'>Processed city {$city->name} | <img src='{$today->condition['icon']}' alt=''> {$today->condition['text']} - <img src='{$tomorrow->condition['icon']}' alt=''> {$tomorrow->condition['text']}</div>";
            } catch (\Exception $e) {
                $forecast[] = $city->name . ' | Forecast not loaded.';
            }
        }

        return view('cities-forecast', compact('forecast'));
    }
}
