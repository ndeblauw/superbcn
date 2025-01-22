<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class SubscribeFooter extends Component
{
    #[Validate('required|min:3|email')]
    public string $email = '';

    public ?string $message = null;

    public function submitEmail()
    {
        $this->message = null;
        $this->validate();

        // do something when correct: add the user to a database
        sleep(2);

        $this->message = 'successfully added you to the database';

        $this->email = '';



    }

    public function render()
    {
        return view('livewire.subscribe-footer');
    }
}
