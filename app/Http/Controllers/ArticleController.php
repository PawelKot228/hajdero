<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::withCount('likes')
            ->withCount([
                'likes as user_likes' => function ($q) {
                    $q->where('user_id', auth()->id());
                }
            ])
            ->withCount('comments')
            ->where(function ($q) {
                $q->where('user_id', auth()->id());
                $q->orWhere('is_published', 1);
            })
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('pages.articles.index', compact('articles'));
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->has('is_published')) {
            $data['published_at'] = now();
        } else {
            $data['is_published'] = 0;
            $data['published_at'] = null;
        }

        $data['cover'] = $request->file('cover', [])->store('covers', 'public');
        $article = $user->articles()->create($data);

        foreach ($request->file('images', []) as $image) {
            Image::create([
                'image' => $image->store('articles', 'public'),
                'imageable_type' => 'articles',
                'imageable_id' => $article->id,
            ]);
        }

        return to_route('articles.show', [$article]);
    }

    public function create()
    {
        return view('pages.articles.create');
    }

    public function show($articleId)
    {
        $article = Article::with([
            'images',
            'comments.subcomments' => function ($q) {
                $q->withCount('likes');
                $q->withCount([
                    'likes as user_likes' => function ($q) {
                        $q->where('user_id', auth()->id());
                    }
                ]);
                $q->orderByDesc('created_at');
            },
            'comments' => function ($q) {
                $q->withCount('likes');
                $q->withCount([
                    'likes as user_likes' => function ($q) {
                        $q->where('user_id', auth()->id());
                    }
                ]);
                $q->withCount('subcomments');
                $q->orderByDesc('created_at');
            }
        ])
            ->withCount('likes')
            ->withCount([
                'likes as user_likes' => function ($q) {
                    $q->where('user_id', auth()->id());
                }
            ])
            ->withCount('comments')
            ->where(function ($q) {
                $q->where('user_id', auth()->id());
                $q->orWhere('is_published', 1);
            })
            ->findOrFail($articleId);

        return view('pages.articles.show', compact('article'));
    }

    public function publish($article)
    {
        $article = Article::findOrFail($article);

        abort_if($article->user_id !== auth()->id(), 403);

        $article->update([
            'is_published' => 1,
            'published_at' => now(),
        ]);

        return redirect()->back();
    }

    public function destroy(Article $article): RedirectResponse
    {
        abort_if($article->user_id !== auth()->id(), 403);

        $article->delete();

        return to_route('articles.index');
    }
}
