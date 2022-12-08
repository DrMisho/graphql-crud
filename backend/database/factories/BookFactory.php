<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'author' => $this->faker->name(),
            'image' => $this->faker->imageUrl(480, 640, 'books'),
            'description' => $this->faker->sentence(40),
            'link' => $this->faker->slug(),
            'featured' => $this->faker->boolean(50),
            'category_id' => Category::factory(),
        ];
    }
}
