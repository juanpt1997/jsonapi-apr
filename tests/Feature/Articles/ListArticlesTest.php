<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListArticlesTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function can_fetch_a_single_article(): void
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        // $response = $this->getJson('/api/v1/articles/' . $article->getRouteKey()); // We are not going to worry about headers by the moment, get route key is used to get slug or field previosly set
        $response = $this->getJson(route('api.v1.articles.show', $article)); // We are not going to worry about headers by the moment, get route key is used to get slug or field previosly set

        // $response->assertSee($article->title);
        // $response->assertJson([
        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'content' => $article->content,
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article),
                ]
            ]
        ]);
    }
}