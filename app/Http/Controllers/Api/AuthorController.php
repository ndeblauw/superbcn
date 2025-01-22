<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\User;

class AuthorController extends Controller
{
    public function index()
    {
        ray()->showQueries();
        $authors = User::with('articles')->paginate(10);

        return AuthorResource::collection($authors);
    }

    public function show(int $id)
    {
        $author = User::findOrFail($id);

        return new AuthorResource($author);
    }
}
