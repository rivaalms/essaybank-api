<?php

namespace Database\Seeders;

use App\Models\AiReview;
use App\Models\Question;
use App\Models\Response;
use App\Models\Review;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->state([
            'name'  => 'Riva Almero',
            'email' => 'rivaalms@proton.me',
            'password'  => Hash::make('password'),
        ])->verified()->create();

        Question::factory()->count(50)->has(
            Response::factory()->count(20)->has(
                Review::factory()->count(5),
                'reviews'
            )->has(
                AiReview::factory()->count(1),
                'aiReviews'
            ),
            'responses'
        )->create();
    }
}
