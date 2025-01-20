<?php

namespace App\Services;

interface IpServiceInterface
{
    public function getLatLon(string $ip): array;
}
