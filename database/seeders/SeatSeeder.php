<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies=[
            1=>1,
            2=>2,
            3=>2,
            5=>2,
            6=>1,
            7=>3,
            8=>1
        ];
        foreach ($movies as $movieId => $theatreId) {
            for($number=1;$number<=32;++$number){
                Seat::create([
                    'movie_id'=>$movieId,
                    'theatre_id'=>$theatreId,
                    'number'=>$number,
                    'is_booked'=>0
                ]);
            }
        }
    }
}
