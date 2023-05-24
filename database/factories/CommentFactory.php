<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'text' => $this->faker->text(),

            //'comment_id' => $this->faker->randomNumber(),
            //'user_id' => User::factory(),
            //'article_id' => User::factory(),
        ];
    }

    public function user(int $userId): static
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId,
            ];
        });
    }

    public function article(int $articleId): static
    {
        return $this->state(function (array $attributes) use ($articleId) {
            return [
                'article_id' => $articleId,
            ];
        });
    }
}
