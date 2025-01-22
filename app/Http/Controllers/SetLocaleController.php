<?php

namespace App\Http\Controllers;

class SetLocaleController extends Controller
{
    public function __invoke(string $locale)
    {
        if (! in_array($locale, ['en', 'es', 'nl', 'fa'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
