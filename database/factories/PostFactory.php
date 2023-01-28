<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->text(30);
        $slug = Str::slug($title);
        return [
            'title' => rtrim($title, '.'),
            'slug' => $slug,
            'description' => fake()->text(2000),
            'image_path' => fake()->randomElement(['https://ucarecdn.com/625385c9-40db-4317-9f19-6624b12b8fb1/', 'https://ucarecdn.com/863d3ba2-3896-4914-ae97-8dd5754aaa3e/', 'https://ucarecdn.com/c157df82-8e9e-4edf-95f5-3c338d46d01f/', 'https://ucarecdn.com/edb2f34e-8038-4113-af47-96531d99f271/']),
            'user_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
