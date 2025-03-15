<?php

namespace Database\Seeders;

use App\Models\BooksGenres;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BooksGenres::factory(10)->create();
    }
}
