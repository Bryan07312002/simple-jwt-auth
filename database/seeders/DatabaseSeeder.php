<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        for ($i=0; $i < 500; $i++) { 
            // Only way I found to seed the database was using for
            // because table posts references itself
            \App\Models\Post::factory(1)->create();
        }
        \App\Models\Like::factory(5000)->create();
        \App\Models\Retweet::factory(5000)->create();

    }
}
