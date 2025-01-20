<?php

namespace App\View\Components;

use App\Services\IpService;
use App\Services\WeatherService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Weather extends Component
{
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $ip = request()->ip();

        if ($ip == '127.0.0.1') {
            $ip = '91.126.71.186';
        }

        // Get the position based on the chosen provider and
        $pos = IpService::init()->getLatLon($ip);
        $weather = (new WeatherService)->getWeather($pos['lat'], $pos['lon']);

        return view('components.weather', compact('weather'));
    }
}
