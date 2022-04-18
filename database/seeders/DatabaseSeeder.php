<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Player;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     * with players and their addresses.
     *
     * @return void
     */
    public function run()
    {
        $players = Player::factory()
                         ->count(5)
                         ->create();

        foreach($players as $player)
        {
            $address = Address::factory()
                              ->make();

            $address->Player()
                    ->associate($player)
                    ->save();
        }
    }
}
