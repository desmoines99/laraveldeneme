<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(2);
        $title = substr($title, 0, strlen($title) - 1);
        $slug = Str::slug($title, '-');
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'body' => $this->faker->paragraph(50),
            'title' => $title,
            'slug' => $slug,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
