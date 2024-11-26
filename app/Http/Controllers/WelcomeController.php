<?php

namespace App\Http\Controllers;

use App\Models\Article;

class WelcomeController extends Controller
{
    public function __invoke()
    {


        $articles = cache()->remember('welcome_articles',3600, function() {
            return Article::published()->take(4)
                ->with('author', 'categories', 'comments')
                ->get()->sortByDesc('published_at');
        } );

        return view('welcome')->with('articles', $articles);
        //return view('welcome', compact('articles'));
    }
}
