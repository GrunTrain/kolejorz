<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Friend;
use App\Models\Station;
use App\Models\Tour;
use App\Models\TourStation;
use App\Models\User;
use App\Models\UserStation;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    const TEST_USERS = 50;
    const CREATE_TEST_DATA = true;

    private function seedStations()
    {
        $json = json_decode(file_get_contents("resources/js/stations.json"), true);
        foreach ($json as &$station) {
            Station::updateOrCreate([
                'id' => $station['id'],
                'name' => $station['title'],
                'lat' => $station['lat'],
                'lon' => $station['lon'],
            ]);
        }
    }

    private function addFriends()
    {
        for ($i = 0; $i < self::TEST_USERS; $i++)
        {
            $numberOfFriends = random_int(2, 4);
            $friends = [];
            for ($j = 0; $j < $numberOfFriends; $j++)
            {
                $friendId = $i;
                while ($i == $friendId || 
                       in_array($friendId, $friends) || 
                       Friend::checkReverseOrder($i, $friendId)) 
                {
                    $friendId = random_int(0, self::TEST_USERS-1);
                }
                array_push($friends, $friendId);
                Friend::updateOrCreate(['user1_id' => $i, 'user2_id' => $friendId]);
            }

        }
    }

    private function addTours()
    {
        for ($i = 0; $i < self::TEST_USERS; $i++) 
        {
            $numberOfTours = random_int(1, 4);
            for ($t = 0; $t < $numberOfTours; $t++)
            {
                $start = DB::table('stations')
                    ->inRandomOrder()
                    ->first()->id;
                $end = $start;
                while ($end == $start) $end = DB::table('stations')
                    ->inRandomOrder()
                    ->first()->id;

                $length = random_int(2, 15);
                $stations = [];
                for ($j = 0; $j < $length; $j++) {
                    $station = DB::table('stations')
                        ->inRandomOrder()
                        ->first()->id;
                    while (in_array($station, $stations) || $station == $start || $station == $end)
                    $station = DB::table('stations')
                        ->inRandomOrder()
                        ->first()->id;

                    array_push($stations, $station);
                }
                $start = Station::where('id', $start)->firstOrFail();
                $end = Station::where('id',  $end)->firstOrFail();
                $tour = Tour::create([
                        'user_id' => $i,
                        'start_station' =>  $start->id,
                        'destination_station' => $end->id,
                        'length' => 2 + $length,
                        'description' => fake()->paragraph(),
                        'is_public' => random_int(0, 1),
                        'date' => now(),
                    ]);

                $userStation = UserStation::firstOrCreate(
                    ["user_id" => $i, "station_id" => $start->id],
                    [
                        "user_id" => $i,
                        "station_id" => $start->id,
                        "times_passed" => 0,
                        "times_visited" => 0,
                    ]
                );
                $userStation->times_visited++;
                $userStation->save();
                foreach ($stations as &$middle_station) {
                    $station = Station::where("id", $middle_station)->firstOrFail();
                    TourStation::create([
                        'tour_id' => $tour->id,
                        'station_id' => $station->id,
                    ]);
                    $userStation = UserStation::firstOrCreate(
                        ["user_id" => $i, "station_id" => $station->id],
                        [
                            "user_id" => $i,
                            "station_id" => $station->id,
                            "times_passed" => 0,
                            "times_visited" => 0,
                        ]
                    );
                    $userStation->times_passed++;
                    $userStation->save();
                }

                $userStation = UserStation::firstOrCreate(
                    ["user_id" => $i, "station_id" => $end->id],
                    [
                        "user_id" => $i,
                        "station_id" => $end->id,
                        "times_passed" => 0,
                        "times_visited" => 0,
                    ]
                );
                $userStation->times_visited++;
                $userStation->save();
            }
            
        }
    }

    public function run()
    {
        if (self::CREATE_TEST_DATA)
        {
            DatabaseSeeder::seedStations();
            User::factory(self::TEST_USERS)->create();
            DatabaseSeeder::addFriends();
            DatabaseSeeder::addTours();
        }
    }
}
