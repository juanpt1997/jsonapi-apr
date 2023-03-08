<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

Route::get('articles/{article}', [ArticleController::class, 'show'])->name('api.v1.articles.show');