<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class WeatherApiService
{
    protected Client $client;
    protected string $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('WEATHER_API_URL'),
        ]);
        $this->apiKey = env('WEATHER_API_KEY');
    }

    private function request(string $method, string $path, array $optionalParams = [])
    {
        $params = [
            'key' => $this->apiKey
        ];

        $options['query'] = array_merge($params, $optionalParams);

        try {
            $response = $this->client
                ->request($method, $path, $options);
            $body = $response->getBody()->getContents();
            return json_decode($body);
        } catch (GuzzleException $e) {
            Log::error('Weatherapi. Request error: ' . $e->getMessage());
            return null;
        }
    }

    public function fetchCityForecast(float $latitude, float $longitude, int $days = 2)
    {
        $params = [
            'days' => $days,
            'q' => $latitude . ',' . $longitude
        ];

        return $this->request('GET', 'forecast.json', $params);
    }
}
