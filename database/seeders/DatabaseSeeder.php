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
    public function run()
    {
        \App\Models\User::factory(10)->create();

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
}
