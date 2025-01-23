<?php

namespace App\Livewire;

use App\Models\Purchase;
use Livewire\Component;

class ArticlePurchaseComponent extends Component
{
    public Purchase $purchase;
    public function mount(int $purchase_id)
    {
        $this->purchase = Purchase::findOrFail($purchase_id);
    }

    public function render()
    {
        return view('livewire.article-purchase-component');
    }
}
