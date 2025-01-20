<?php

namespace App\Services;

class IpService
{
    public static function init()
    {
        $CLASS = config('services.ipservice');

        return new $CLASS;
    }
}
