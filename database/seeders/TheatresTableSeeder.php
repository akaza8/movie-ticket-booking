<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TheatresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('theatres')->insert([
            [
                'name' => 'Cinema 1',
                'location_id' => 1,
            ],
            [
                'name' => 'Cinema 2',
                'location_id' => 2,
            ],
            [
                'name' => 'Cinema 3',
                'location_id' => 3,
            ],
            [
                'name' => 'Cinema 4',
                'location_id' => 4,
            ],
        ]);
    }
}
