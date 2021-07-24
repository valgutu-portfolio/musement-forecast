<?php

namespace App\Repositories\Interfaces;

use App\Models\City;

interface ICityRepository extends IBaseRepository
{
    public function getByMusementId(int $id): ?City;
}
