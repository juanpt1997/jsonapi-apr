<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return ArticleResource::collection($articles); // we need a collection of the article resource, in other words, each article wrapped in an article resource
    }

    public function show(Article $article)
    {
        // return $article;
        // ? Response expected
        // return response()->json([
        //     'data' => [
        //         'type' => 'articles',
        //         'id' => (string) $article->getRouteKey(),
        //         'attributes' => [
        //             'title' => $article->title,
        //             'slug' => $article->slug,
        //             'content' => $article->content,
        //         ],
        //         'links' => [
        //             'self' => route('api.v1.articles.show', $article),
        //         ]
        //     ]
        // ]);

        // Using ArticleResource
        return ArticleResource::make($article);
    }
}
