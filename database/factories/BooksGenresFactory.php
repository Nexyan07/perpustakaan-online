<?php

namespace Database\Factories;

use App\Models\Books;
use App\Models\Genres;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BooksGenresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'books_id' => Books::factory(),
            'genres_id' => Genres::inRandomOrder()->first()->id ?? Genres::factory(),
        ];
    }
}
