<?php

namespace App\Livewire;

use Livewire\Component;

class TokenGeneration extends Component
{
    public ?string $plain_text = null;
    public function generateToken()
    {
        $generated_token = auth()->user()->createToken('fancyname');

        $this->plain_text = $generated_token->plainTextToken;
    }

    public function render()
    {
        return view('livewire.token-generation');
    }
}
