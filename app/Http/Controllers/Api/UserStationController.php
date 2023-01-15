<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserStationResource;
use App\Models\Station;
use App\Models\UserStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class  UserStationController extends Controller
{

    public function show($id)
    {
        $id = Auth::id();
        $userStations = UserStation::where('user_id', $id)->get();
        $stations = [];

        foreach ($userStations as $userStation) {
            $data = Station::where('id', $userStation->station_id)->firstOrFail();

            if ($userStation->times_visited >= $userStation->times_passed) {
                $data->status = 'odwiedzona';
            } else {
                $data->status = 'przejechana';
            }

            $data->timesVisited = $userStation->times_visited;
            $data->timesPassed = $userStation->times_passed;

            array_push($stations, $data);
        }

        return UserStationResource::collection($stations);
    }

    public function store(Request $request)
    {
        $userStation = UserStation::firstOrCreate(
            [
                "user_id" => Auth::id(),
                'station_id' => $request->input('station_id'),
            ],
            [
                'user_id' => Auth::id(),
                'station_id' => $request->input('station_id'),
                'times_visited' => 0,
                'times_passed' => 0,
            ]
        );

        if ($request->input('status')) {
            $userStation->times_visited++;
        } else {
            $userStation->times_passed++;
        }

        $userStation->save();

        return response()->json([
            'alert' => "Dodano do Moich stacji!",
        ]);
    }

    public function destroy($id)
    {
        $station = UserStation::where('station_id', $id)->where('user_id', Auth::id());
        $station->delete();
    }

    public function index(Request $request)
    {
        $stations = UserStation::where('user_id', Auth::id())->get();
        $favourite_station = 0;
        $favourite_station_records = 0;
        $stations_passed = 0;
        $stations_visited = 0;
        $total_passes = 0;
        $total_visits = 0;

        foreach ($stations as $station)
        {
            if ($station->times_passed + $station->times_visited > $favourite_station_records) 
            {
                $favourite_station_records = $station->times_passed + $station->times_visited;
                $favourite_station = Station::where('id', $station->station_id)->first()->name;
            }
            if ($station->times_passed) $stations_passed++;
            if ($station->times_visited) $stations_visited++;
            $total_passes += $station->times_passed;
            $total_visits += $station->times_visited;
        }

        return response()->json([
            'favourite_station' => $favourite_station,
            'favourite_station_records' => $favourite_station_records,
            'stations_passed' => $stations_passed,
            'stations_visited' => $stations_visited,
            'total_passes' => $total_passes,
            'total_visits' => $total_visits,
        ]);
    }
}
