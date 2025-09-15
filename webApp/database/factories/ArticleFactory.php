<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $published = $this->faker->boolean(70);
        return [
            'title' => $this->faker->sentence(6),
            'body' => $this->faker->paragraphs(mt_rand(2, 5), true),
            'is_published' => $published,
            'published_at' => $published ? $this->faker->dateTimeBetween('-2 years', 'now') : null,
        ];
    }
}

