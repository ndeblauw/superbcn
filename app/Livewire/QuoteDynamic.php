<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class QuoteDynamic extends Component
{
    private string $endpoint;

    private string $api_key;

    public string $quote = '';

    public string $author = '';

    public function __construct()
    {
        $this->endpoint = 'https://api.api-ninjas.com/v1/quotes';
        $this->api_key = config('services.api-ninjas');
    }

    private function getQuote(): void
    {
        try {
            $response = Http::withHeaders([
                'X-Api-Key' => $this->api_key,
            ])->get($this->endpoint);

            if ($response->successful()) {
                $this->quote = json_decode($response->body())[0]->quote;
                $this->author = json_decode($response->body())[0]->author;
            } else {
                throw new \Exception;
            }

        } catch (\Exception $e) {
            $this->quote = 'You should not worry about your presentation tomorrow';
            $this->author = ' Nico';
        }
    }

    public function newquote()
    {
        $this->getQuote();
        $this->render();
    }

    public function render()
    {
        return view('livewire.quote-dynamic');
    }
}
