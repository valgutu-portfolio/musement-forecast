<?php

namespace App\Services;

use App\Repositories\Interfaces\ICityRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CityService
{
    protected MusementApiService $musementService;
    protected ICityRepository $cityRepository;

    public function __construct(MusementApiService $musementService, ICityRepository $cityRepository)
    {
        $this->musementService = $musementService;
        $this->cityRepository = $cityRepository;
    }

    public function allWithForecast(): Collection
    {
        return $this->cityRepository->allWithForecast();
    }

    public function updateAll(): bool
    {
        $cities = $this->musementService->fetchCities();

        if (!is_null($cities)) {
            foreach ($cities as $data) {
                $city = $this->cityRepository->getByMusementId($data->id);

                if (is_null($city)) {
                    try {
                        $this->cityRepository->create([
                            'name' => $data->name,
                            'musementapi_id' => $data->id,
                            'latitude' => $data->latitude,
                            'longitude' => $data->longitude
                        ]);
                    } catch (Exception $e) {
                        Log::error("City {$data->id} not saved. Error: " . $e->getMessage());
                    }
                }
            }
            $success = true;
        } else {
            Log::error('Something went wrong. No cities found.');
            $success = false;
        }

        return $success;
    }
}
