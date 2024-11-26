<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'nico',
            'email' => 'nico@deblauwe.be',
            'password' => '$2y$12$u/SSUYT3uLh5xlDLoKw6b.UDbD.nnzYo4ghj/CQJFt4jrvm0y7jZq',
            'is_admin' => true,
        ]);
        User::factory(10)->create();

        Article::factory(100)->create();
        Comment::factory(200)->create();

        Category::factory(10)->create();

        foreach (Article::take(100)->get() as $article) {
            $list_of_categories = Category::inRandomOrder()->take(random_int(0, 4))->get();
            $article->categories()->attach($list_of_categories);
        }

        Category::factory(1)->create(); // Category without articles

    }
}
