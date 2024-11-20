<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlePublishController extends Controller
{
    public function __invoke(int $id, Request $request)
    {
        $article = \App\Models\Article::findOrFail($id);

        $article->authorized(auth()->user());

        $article->update([
            'published_at' => now(),
        ]);

        return redirect()->back();
    }
}
