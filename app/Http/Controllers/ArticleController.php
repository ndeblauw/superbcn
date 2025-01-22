<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Notifications\InformAuthorOnArticleRead;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()->orderByDesc('published_at')->get();
        $articles->load('author', 'categories', 'comments');

        return view('articles.index')->with('articles', $articles);

    }

    public function show(string $slug)
    {
        $article = Article::published()->where('slug', $slug)->sole();

        $article->author->notify(new InformAuthorOnArticleRead(now(), $article->id));

        return view('articles.show')->with('article', $article);
    }
}
