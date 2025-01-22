<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class IpInfoService implements IpServiceInterface
{
    protected string $endpoint;

    protected string $api_token;

    public function __construct()
    {
        ray('ipinfo service')->green();

        $this->endpoint = config('services.ipinfo.endpoint', '');
        $this->api_token = config('services.ipinfo.token', '');
    }

    public function getLatLon(string $ip): array
    {
        try {
            $response = Http::get($this->endpoint.$ip, [
                'token' => $this->api_token,
            ]);

            if ($response->successful()) {
                ray($response->body())->green();

                $body = json_decode($response->body());
                $position = [
                    'lat' => Str::of($body->loc)->before(',')->toString(),
                    'lon' => Str::of($body->loc)->after(',')->toString(),
                ];
            } else {
                ray($response)->red();
                ray($response->body())->red();
            }

        } catch (\Exception $e) {
            ray($e)->red();
        }

        return $position;
    }
}
