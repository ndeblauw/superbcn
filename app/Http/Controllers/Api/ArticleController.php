<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleIndexResource;
use App\Http\Resources\ArticleShowResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10);

        return ArticleIndexResource::collection($articles);
    }

    public function show(string $slug)
    {
        $article = Article::with('author')->where('slug', $slug)->sole();

        return new ArticleShowResource($article);
    }
}
