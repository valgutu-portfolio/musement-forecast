<?php

namespace App\Repositories\Interfaces;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

interface ICityRepository extends IBaseRepository
{
    public function getByMusementId(int $id): ?City;

    public function allWithForecast(): Collection;

}
