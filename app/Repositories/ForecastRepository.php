<?php

namespace App\Repositories;

use App\Models\Forecast;
use App\Repositories\Interfaces\IForecastRepository;

class ForecastRepository extends BaseRepository implements IForecastRepository
{
    public function __construct(Forecast $forecast)
    {
        $this->setModel($forecast);
    }

    public function getCityForecastByDay(int $cityId, string $date): ?Forecast
    {
        return $this->model
            ->where('city_id', $cityId)
            ->where('date', $date)
            ->first();
    }

    public function create(array $fillable): ?Forecast
    {
        $forecast = $this->getCityForecastByDay($fillable['city_id'], $fillable['date']);

        if (is_null($forecast)) {
            $forecastSaved = $this->model->create($fillable);
        } else {
            $forecastSaved = null;
        }

        return $forecastSaved;
    }
}
