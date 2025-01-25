<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleIndexResource;
use App\Http\Resources\ArticleShowResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10);

        return ArticleIndexResource::collection($articles);
    }

    public function show(int $article)
    {
        $article = Article::with('author')->findOrFail($article);

        return new ArticleShowResource($article);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'slug' => ['nullable', 'string', 'min:5', 'max:255', 'unique:articles'],
            'content' => ['required', 'string'],
            'categories' => ['nullable', 'array'],
        ]);

        $article = Article::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'author_id' => auth()->user()->id,
        ]);

        return new ArticleShowResource($article);
    }

    public function update(Request $request, Article $article)
    {
        $article->authorized(auth()->user());

        $valid = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'slug' => ['nullable', 'string', 'min:5', 'max:255', 'unique:articles'],
            'content' => ['required', 'string'],
            'categories' => ['nullable', 'array'],
        ]);

        $article->update($valid);

        return new ArticleShowResource($article);
    }


    public function destroy(Article $article)
    {
        $article->authorized(auth()->user());

        $article->delete();

        return response()->noContent();
    }
}
