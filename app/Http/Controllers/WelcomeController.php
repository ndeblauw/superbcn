<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $articles = Article::whereNotNull('published_at')->get()->sortByDesc('published_at');

        return view('welcome')->with('articles', $articles);
        //return view('welcome', compact('articles'));
    }
}
