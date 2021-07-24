<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Interfaces\ICityRepository;

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
}
