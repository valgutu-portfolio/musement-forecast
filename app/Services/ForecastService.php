<?php

namespace App\Services;

use App\Models\City;
use App\Models\Forecast;
use App\Repositories\Interfaces\ICityRepository;
use App\Repositories\Interfaces\IForecastRepository;
use Illuminate\Support\Facades\Log;

class ForecastService
{
    protected WeatherApiService $weatherApiService;
    protected IForecastRepository $forecastRepository;
    protected ICityRepository $cityRepository;

    public function __construct(WeatherApiService $weatherApiService, IForecastRepository $forecastRepository, ICityRepository $cityRepository)
    {
        $this->weatherApiService = $weatherApiService;
        $this->forecastRepository = $forecastRepository;
        $this->cityRepository = $cityRepository;
    }

    public function updateExpiredForecast(): bool
    {
        do {
            $cities = $this->cityRepository->all();

            foreach ($cities as $city) {
                $this->updateCityForecast($city);
            }
        } while (empty($cities));

        return true;
    }

    public function updateCityForecast(City $city): bool
    {
        $weatherapiForecast = $this->weatherApiService
            ->fetchCityForecast($city->latitude, $city->longitude);

        if (is_null($weatherapiForecast))
            return false;

        try {
            $forecastDays = $weatherapiForecast->forecast->forecastday;

            foreach ($forecastDays as $forecastDay) {
                $this->saveForecast($city->id, $forecastDay);
            }
        } catch (\Exception $e) {
            Log::error('Forecast service. Update error: ' . $e->getMessage());
        }

        return true;
    }

    public function saveForecast(int $cityId, object $forecast): ?Forecast
    {
        $fillable = [
            'city_id' => $cityId,
            'date' => $forecast->date,
            'condition' => $forecast->day->condition
        ];

        return $this->forecastRepository->create($fillable);
    }
}
