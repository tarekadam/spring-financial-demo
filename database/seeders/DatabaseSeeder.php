<?php

namespace Database\Seeders;

use App\Models\Player;
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
        Player::factory()
                          ->count(5)
                          ->create();
    }
}
