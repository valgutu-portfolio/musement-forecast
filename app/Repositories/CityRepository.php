<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Interfaces\ICityRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CityRepository extends BaseRepository implements ICityRepository
{
    public function __construct(City $city)
    {
        $this->setModel($city);
    }

    public function getByMusementId(int $id): ?City
    {
        return $this->model->where('musementapi_id', $id)->first();
    }

    public function allWithForecast(): Collection
    {
        return $this->model->with(['forecast' => function ($q) {
            $q->whereDate('date', '>=', Carbon::today());
        }])->get();
    }
}
