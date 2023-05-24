<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(50)->create();

        $users = User::all();

        Article::factory(25)->create()
            ->each(function (Article $article) use ($users) {
                $article->user_id = $users->random(1)->first()->getKey();
                $article->save();

                $article->likes()->saveMany(
                    Like::factory(random_int(0, 5))
                        ->make()
                        ->each(fn(Like $like) => $like->fill([
                            'user_id' => $users->random(1)->first()->getKey()
                        ]))
                );

                $comments = $article->comments()->saveMany(
                    Comment::factory(random_int(0, 5))
                        ->make()
                        ->each(fn(Comment $comment) => $comment->fill([
                            'user_id' => $users->random(1)->first()->getKey()
                        ]))
                );

                foreach ($comments as $comment) {
                    $comment->likes()->saveMany(
                        Like::factory(random_int(0, 5))
                            ->make()
                            ->each(fn(Like $like) => $like->fill([
                                'user_id' => $users->random(1)->first()->getKey()
                            ]))
                    );

                    $subComments = $comment->subcomments()
                        ->saveMany(
                            Comment::factory(random_int(0, 2))
                                ->make()
                                ->each(fn(Comment $comment) => $comment->fill([
                                    'user_id' => $users->random(1)->first()->getKey()
                                ]))
                        );

                    foreach ($subComments as $subComment) {
                        $subComment->likes()->saveMany(
                            Like::factory(random_int(0, 3))
                                ->make()
                                ->each(fn(Like $like) => $like->fill([
                                    'user_id' => $users->random(1)->first()->getKey()
                                ]))
                        );
                    }
                }

            });
    }
}
