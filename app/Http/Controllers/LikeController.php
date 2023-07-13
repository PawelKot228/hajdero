<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(LikeRequest $request)
    {
        $data = $request->validated();
        if ($data['mode'] == 1) {
            Like::create([
                'user_id' => auth()->id(),
                'likeable_type' => $data['type'],
                'likeable_id' => $data['parent_id'],
            ]);
        } else {
            Like::where('user_id', auth()->id())
                ->where('likeable_type', $data['type'])
                ->where('likeable_id', $data['parent_id'])
                ->delete();
        }

        return redirect(url()->previous().'#'.$data['type'].'-'.$data['parent_id']);
    }
}
