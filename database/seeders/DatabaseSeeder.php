<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private function seedStations()
    {
        $json = json_decode(file_get_contents("resources/js/stations.json"), true);
        foreach ($json as &$station) {
            \App\Models\Station::updateOrCreate([
                'id' => $station['id'],
                'name' => $station['title'],
                'lat' => $station['lat'],
                'lon' => $station['lon'],
            ]);
        }
    }

    private function addFriends()
    {
        for ($i = 0; $i < 10; $i++)
        {
            $numberOfFriends = random_int(2, 4);
            $friends = [];
            for ($j = 0; $j < $numberOfFriends; $j++)
            {
                $friendId = $i;
                while ($i == $friendId || 
                       in_array($friendId, $friends) || 
                       \App\Models\Friend::checkReverseOrder($i, $friendId)) 
                {
                    $friendId = random_int(0, 9);
                }
                array_push($friends, $friendId);
                \App\Models\Friend::updateOrCreate(['user1_id' => $i, 'user2_id' => $friendId]);
            }

        }
    }

    private function addTours()
    {
        
    }

    public function run()
    {
        DatabaseSeeder::seedStations();
        \App\Models\User::factory(10)->create();
        DatabaseSeeder::addFriends();
        DatabaseSeeder::addTours();
    }
}
