<?php

use App\Models\Article;

test('welcome page is displayed', function () {
    // Act
    $response = $this->get('/');

    // Assert
    $response->assertStatus(200);
});

test('4 most recent articles are shown', function() {
    // Arrange
    $articles = Article::factory(5)->published()->nodeleted()->create();

    $toCheck = $articles->sortByDesc('published_at')->take(4);
    $notToBeSeen = $articles->sortByDesc('published_at')->skip(4)->first();

    // Act
    $response = $this->get('/');

    // Assert
    $response->assertSeeInOrder($toCheck->pluck('title')->toArray());
    $response->assertDontSee($notToBeSeen->title);
});

test('assert publishing changes content of welcome page', function() {
    // Arrange
    $articles = Article::factory(10)->nodeleted()->create();
    $articles = $articles->sortByDesc('published_at');




    $toCheck = $articles->sortByDesc('published_at')->take(4);
    $notToBeSeen = $articles->sortByDesc('published_at')->skip(4);

    // Act
    $response = $this->get('/');

    // Assert
    $response->assertSeeInOrder($toCheck->pluck('title')->toArray());
    $response->assertDontSee($notToBeSeen->pluck('title'));

    // Act
    $newArticle = Article::factory()->published()->create();

    // Assert
    $response = $this->get('/');
    $response->assertSee($newArticle->title);
})->skip();
