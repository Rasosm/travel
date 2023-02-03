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

        
    }

    
}
