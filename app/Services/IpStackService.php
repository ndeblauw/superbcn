<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class IpStackService implements IpServiceInterface
{
    protected string $endpoint;
    protected string $api_key;

    public function __construct()
    {
        ray('ipstack service')->green();
        $this->endpoint = config('services.ipstack.endpoint', '');
        $this->api_key = config('services.ipstack.key', '');
    }

    public function getLatLon(string $ip): array
    {
        try {
            $response = Http::get($this->endpoint.$ip, [
                'access_key' => $this->api_key,
            ]);

            if($response->successful()) {
                ray($response->body() )->green();

                $body = json_decode($response->body());
                $position = [
                    'lat' => Str::of($body->latitude)->toString(),
                    'lon' => Str::of($body->longitude)->toString(),
                ];
            } else {
                ray($response)->red();
                ray($response->body() )->red();
            }

        } catch (\Exception $e) {
            ray($e)->red();
        }

        return $position;
    }

}
