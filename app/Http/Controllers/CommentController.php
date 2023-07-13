<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $attributes = $request->validated();
        $attributes[$attributes['type'].'_id'] = $attributes['parent_id'];
        unset($attributes['type'], $attributes['parent_id']);
        Comment::create([
            'user_id' => auth()->id(),
            ...$attributes
        ]);

        return redirect()->back();
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        abort_if($comment->user_id !== auth()->id(), 403);
        $comment->delete();

        return redirect()->back();
    }
}
