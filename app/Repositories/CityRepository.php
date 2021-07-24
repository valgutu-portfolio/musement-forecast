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
}
