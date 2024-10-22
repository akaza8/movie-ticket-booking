<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'title' => 'The Dark Knight',
                'genre' => 'Action',
                'rating' => 9.0,
                'duration' => 152,
                'cast' => 'Christian Bale, Heath Ledger, Aaron Eckhart',
                'theatre_id' => 1,
                'showtime' => '2024-10-16 22:00:00',
                'image_url' => 'assets/images/batman.jpg',
                'price'=>480,
            ],

            [
                'title' => 'The Amazing Spider-Man',
                'genre' => 'Action',
                'rating' => 7.0,
                'duration' => 336,
                'cast' => 'Andrew Garfield, Emma Stone, Rhys Ifans',
                'theatre_id' => 2,
                'showtime' => '2024-10-18 19:00:00',
                'image_url' => 'assets/images/theAmazingSpiderman.jpg',
                'price'=>184,
            ],
            [
                'title' => 'Avengers',
                'genre' => 'Action',
                'rating' => 8.0,
                'duration' => 443,
                'cast' => 'Robert Downey Jr., Chris Evans, Scarlett Johansson',
                'theatre_id' => 1,
                'showtime' => '2024-10-19 21:00:00',
                'image_url' => 'assets/images/avengers.jpg',
                'price'=>283,
            ],
            [
                'title' => 'The Emoji Movie',
                'genre' => 'Animation',
                'rating' => 5.7,
                'duration' => 86,
                'cast' => 'T.J. Miller, James Corden, Anna Faris',
                'theatre_id' => 3,
                'showtime' => '2024-10-20 15:00:00',
                'image_url' => 'assets/images/emojiMovie.jpg',
                'price'=>140,
            ],
            [
                'title' => 'The Hobbit',
                'genre' => 'Fantasy',
                'rating' => 7.8,
                'duration' => 169,
                'cast' => 'Martin Freeman, Ian McKellen, Richard Armitage',
                'theatre_id' => 2,
                'showtime' => '2024-10-21 17:00:00',
                'image_url' => 'assets/images/hobbit.jpg',
                'price'=>200,
            ],
            [
                'title' => 'Kick-Ass 2',
                'genre' => 'Action',
                'rating' => 6.6,
                'duration' => 103,
                'cast' => 'Aaron Taylor-Johnson, Chloë Grace Moretz, Jim Carrey',
                'theatre_id' => 1,
                'showtime' => '2024-10-22 20:30:00',
                'image_url' => 'assets/images/kickAss2.jpg',
                'price'=>130,
            ],
            [
                'title' => 'Oblivion',
                'genre' => 'Sci-Fi',
                'rating' => 7.0,
                'duration' => 124,
                'cast' => 'Tom Cruise, Morgan Freeman, Andrea Riseborough',
                'theatre_id' => 3,
                'showtime' => '2024-10-23 14:00:00',
                'image_url' => 'assets/images/oblivion.jpg',
                'price'=>300,
            ],
            [
                'title' => 'Storm',
                'genre' => 'Drama',
                'rating' => 6.3,
                'duration' => 102,
                'cast' => 'N/A',
                'theatre_id' => 2,
                'showtime' => '2024-10-24 16:00:00',
                'image_url' => 'assets/images/storm.jpg',
                'price'=>280,
            ],
        ]);
    }
}
