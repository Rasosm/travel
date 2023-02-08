<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('users')->insert([
            'name' => 'Rasa',
            'email' => 'rasosm@gmail.com',
            'password' => Hash::make('321'),
            'role' => 'admin'
        ]);
         DB::table('users')->insert([
            'name' => 'Teja',
            'email' => 'teja@gmail.com',
            'password' => Hash::make('321'),
            'role' => 'manager'
        ]);


         $faker = Faker::create();

        foreach(range(1, 21) as $i) {
            $month = rand(1,5);
            $day = rand(1, 28);
            $monthEnd = rand(6,12);
            $dayEnd = rand(1, 28);
            DB::table('countries')->insert([
                'title' => $faker->country,
                'season_start' => '2023-'.$month.'-'.$day,
                'season_end' => '2023-'.$monthEnd.'-'.$dayEnd
            ]);
        }

         foreach(range(1, 21) as $i) {
            $price = rand(359, 5970);
            $duration = rand(1,14);
            $month = rand(1,5);
            $day = rand(1, 28);
            $monthEnd = rand(6,12);
            $dayEnd = rand(1, 28);
            DB::table('hotels')->insert([
                               'title' => $faker->city,
                'price' => $price,
                'start' => '2023-'.$month.'-'.$day,
                'end' => '2023-'.$monthEnd.'-'.$dayEnd,
                'duration' => $duration,
                'country_id' => $i,
                'desc' => $faker->realText(500, 5)
            ]);
        }
        

        
    }

    
}
