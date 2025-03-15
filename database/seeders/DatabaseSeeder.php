<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Books;
use App\Models\Genres;
use App\Models\BooksGenres;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 5 Genre
        $genres = Genres::factory(5)->create();

        // Buat 100 Buku
        Books::factory(100)->create()->each(function ($book) use ($genres) {
            // Setiap buku memiliki 1 hingga 3 genre secara random
            $book->genres()->attach($genres->random(rand(1, 3))->pluck('id')->toArray());
        });
        User::insert([
            [
                'foto' => 'profil-cowok.jpg',
                'name' => 'Anto',
                'address' => 'Talamangape',
                'email' => 'anto@gmail.com',
                'telepon' => '089695955912',
                'password' => bcrypt('12121212'),
                'role' => 'member',
            ],
            [
                'foto' => 'profil-cewek.jpg',
                'name' => 'Bila',
                'address' => 'Regency',
                'email' => 'bila@gmail.com',
                'telepon' => '089876543212',
                'password' => bcrypt('12121212'),
                'role' => 'admin',
            ]
        ]);
    }
}
