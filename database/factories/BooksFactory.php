<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil semua file dari folder 'public/img'
        $files = File::files(public_path('img/books'));

        // Pilih file secara acak
        $randomFile = $files[array_rand($files)];

        // Ambil hanya nama file
        $fileName = $randomFile->getFilename();
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'year' => $this->faker->year,
            'isbn' => $this->faker->isbn13,
            'copies_total' => $copies_total = $this->faker->numberBetween(1, 10),
            'copies_available' => $this->faker->numberBetween(1, $copies_total),
            'foto' => $fileName,
            'description' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
        ];
    }
}
