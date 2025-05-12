<?php

namespace Database\Seeders;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

public function run()
{
    Book::create([
        'title' => 'Une si long lettre',
        'author' => 'Mariama Ba',
        'description' => 'Description du livre ',
        'published_at' => now(),
    ]);

    Book::create([
        'title' => 'Le Veritable Amour',
        'author' => 'Madina Aidara',
        'description' => 'Description du livre',
        'published_at' => now(),
    ]);
}

}


