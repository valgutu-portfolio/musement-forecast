<?php

namespace App\Repositories\Interfaces;

use App\Models\Forecast;

interface IForecastRepository extends IBaseRepository
{
    public function getCityForecastByDay(int $cityId, string $date): ?Forecast;

    public function create(array $fillable): ?Forecast;

    public function deleteExpired(): bool ;
}
