<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MostPopular extends Component
{
    public $articles;
    public function __construct()
    {
        $this->articles = Article::published()->take(3)->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.most-popular');
    }
}
