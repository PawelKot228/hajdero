<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'text' => $this->faker->text(),
            'is_published' => true,
            'published_at' => Carbon::now(),
            'user_id' => User::factory(),
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

    public function isPublished(bool $status): static
    {
        return $this->state(function (array $attributes) use ($status) {
            return [
                'is_published' => $status,
            ];
        });
    }
}
