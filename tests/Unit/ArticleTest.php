<?php

use App\Models\Article;

use function Spatie\PestPluginTestTime\testTime;

it('adds a slug when a post is created and no slug is given')
    ->expect(fn () => Article::factory()->create([
        'title' => 'My First Post',
        'slug' => null
    ]))
    ->slug->toEqual('my-first-post');

it('it uses the given slug when a post is created with slug defined')
    ->expect(fn () => Article::factory()->create([
        'title' => 'My First Post',
        'slug' => 'oh-user-decided-something-else'
    ]))
    ->slug->toEqual('oh-user-decided-something-else');

// Check that slug is unique for two articles with the same title


it('can determine if an article is future scheduled through the scope', function () {
    // Arrange
    testTime()->freeze();
    $aPublisedPost = Article::factory()->create(['published_at' => now()]);
    $aDraftPost = Article::factory()->create(['published_at' => null]);

    ray(now())->green();

    // Act & Assert 1
    testTime()->subMinute(1);
    ray(now())->orange();
    $publishedPosts = Article::published()->get();
    expect($publishedPosts)->toHaveCount(0);

    // Act & Assert 2
    testTime()->addMinute(2);
    ray(now())->blue();
    $publishedPosts = Article::published()->get();
    expect($publishedPosts)->toHaveCount(1);
    ray($publishedPosts->first()->id)->red()->label('assertion');
    ray($aPublisedPost->id)->red()->label('created');

    expect($publishedPosts->first()->id)->toEqual($aPublisedPost->id);
})->skip();
