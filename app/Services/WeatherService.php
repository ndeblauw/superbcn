<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected string $endpoint;

    protected string $api_key;

    public function __construct()
    {
        $this->endpoint = config('services.openweather.endpoint', '');
        $this->api_key = config('services.openweather.key', '');
    }

    public function getWeather($lat, $lon): array
    {
        try {
            $response = Http::get($this->endpoint, [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->api_key,
            ]);

            if ($response->successful()) {
                ray($response->body())->green();

                $body = json_decode($response->body());
                $weather = [
                    'main' => $body->weather[0]->main,
                    'description' => $body->weather[0]->description,
                    'temperature' => $body->main->temp - 273,
                ];
            } else {
                ray($response)->red();
                ray($response->body())->red();
            }

        } catch (\Exception $e) {
            ray($e)->red();
        }

        return $weather;
    }
}
