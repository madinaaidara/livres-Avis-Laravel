<?php

namespace Database\Seeders;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

public function run()
{
    Review::create([
        'book_id' => 1, 
        'user_id' => 1, 
        'rating' => 4,
        'comment' => 'Très bon livre !',
    ]);

    Review::create([
        'book_id' => 2,
        'user_id' => 2,
        'rating' => 5,
        'comment' => 'Excellent, un vrai chef-d œuvre !',
    ]);

    Review::create([
        'book_id' => 1,
        'user_id' => 3,
        'rating' => 5,
        'comment' => 'Bravo aux Femmes!',
    ]);
}

    
}
