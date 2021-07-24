<?php

namespace App\Repositories;

use App\Models\Forecast;
use App\Repositories\Interfaces\IBaseRepository;

class ForecastRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(Forecast $forecast)
    {
        $this->setModel($forecast);
    }
}
