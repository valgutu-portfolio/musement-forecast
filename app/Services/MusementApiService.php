<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class MusementApiService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('MUSEMENT_API_URL'),
        ]);
    }

    private function request(string $method, string $path)
    {
        try {
            $response = $this->client
                ->request($method, $path);
            $body = $response->getBody()->getContents();
            return json_decode($body);
        } catch (GuzzleException $e) {
            Log::error('Musement. Request error: ' . $e->getMessage());
            return null;
        }
    }

    public function fetchCities()
    {
        return $this->request('GET', 'cities.json');
    }

    public function fetchCity(int $id)
    {
        $path = "cities/{$id}.json";
        return $this->request('GET', $path);
    }
}
