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
}
