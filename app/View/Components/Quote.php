<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class Quote extends Component
{
    private string $endpoint;

    private string $api_key;

    public function __construct()
    {
        $this->endpoint = 'https://api.api-ninjas.com/v1/quotes';
        $this->api_key = config('services.api-ninjas');
    }

    private function getQuote()
    {
        try {
            $response = Http::withHeaders([
                'X-Api-Key' => $this->api_key,
            ])->get($this->endpoint);

            if ($response->successful()) {
                $quote = json_decode($response->body())[0]->quote;
                $author = json_decode($response->body())[0]->author;
            } else {
                throw new \Exception;
            }

        } catch (\Exception $e) {
            $quote = 'You should not worry about your presentation tomorrow';
            $author = ' Nico';
        }

        return [$quote, $author];
    }

    public function render(): View|Closure|string
    {
        [$quote, $author] = cache()->remember(
            'quote',
            10,
            fn () => $this->getQuote()
        );

        return view('components.quote', compact('quote', 'author'));
    }
}
