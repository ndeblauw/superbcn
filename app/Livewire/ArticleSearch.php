<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleSearch extends Component
{
    public string $search = '';

    public function render()
    {
        $articles = ($this->search === '')
            ? collect([])
            : Article::query()
                ->where('title', 'like', "%{$this->search}%")
                ->orWhere('content', 'like', "%{$this->search}%")
                ->take(10)
                ->get();

        return view('livewire.article-search', compact('articles'));
    }
}
