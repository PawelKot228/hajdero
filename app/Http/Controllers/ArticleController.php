<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::withCount('likes')
            ->withCount('comments')
            ->where('is_published', 1)
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('pages.articles.index', compact('articles'));
    }

    public function show($article)
    {
        $article = Article::with([
            'comments.subcomments',
            'comments' => function ($q) {
                $q->withCount('likes');
                $q->withCount('subcomments');
            }
        ])
            ->withCount('likes')
            ->withCount('comments')
            ->findOrFail($article);

        return view('pages.articles.show', compact('article'));
    }
}
