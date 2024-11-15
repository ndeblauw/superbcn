<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(int $id)
    {
        $article = Article::published()->where('id', $id)->first();

        if($article === null){
            abort(404);
        }

        return view('articles.show')->with('article', $article);
    }
}
