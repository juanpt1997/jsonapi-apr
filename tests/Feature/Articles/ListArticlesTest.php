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
        // $this->withoutExceptionHandling();

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

    /** @test */
    public function can_fetch_all_articles()
    {
        $articles = Article::factory(3)->create();

        $response = $this->getJson(route('api.v1.articles.index'));

        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'articles',
                    'id' => (string) $articles[0]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[0]->title,
                        'slug' => $articles[0]->slug,
                        'content' => $articles[0]->content,
                    ],
                    'links' => [
                        'self' => route('api.v1.articles.show', $articles[0])
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $articles[1]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[1]->title,
                        'slug' => $articles[1]->slug,
                        'content' => $articles[1]->content,
                    ],
                    'links' => [
                        'self' => route('api.v1.articles.show', $articles[1])
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $articles[2]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[2]->title,
                        'slug' => $articles[2]->slug,
                        'content' => $articles[2]->content,
                    ],
                    'links' => [
                        'self' => route('api.v1.articles.show', $articles[2])
                    ]
                ],
            ]
        ]);


    }
}
