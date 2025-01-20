<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $counter = 0;

    public function mount(int $initvalue = 0)
    {
        $this->counter = $initvalue;
    }

    public function increment()
    {
        $this->counter++;
    }

    public function decrement()
    {
        $this->counter--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
