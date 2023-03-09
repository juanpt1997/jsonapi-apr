<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    public function index(): ArticleCollection
    {
        // $articles = Article::all();
        // return ArticleResource::collection($articles); // we need a collection of the article resource, in other words, each article wrapped in an article resource

        // ? As we needed to return the link of the route that lists all articles, we created an ArticleCollection to do that work
        return ArticleCollection::make(Article::all()); 
        // ? Behind scenes each article in this collection uses ArticleResource, we didn't set it manually, though it makes that automatically as ArticleCollection and ArticleResource have the same object name (prefix)
        // ? If we want to set it manually let's take a look at ARticleCollection...
    }

    public function show(Article $article): ArticleResource
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
