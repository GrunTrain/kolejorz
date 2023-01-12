<?php

namespace App\Http\Controllers\Api;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\TourStation;
use App\Models\UserStation;

class TourController extends Controller
{
    public function store(Request $request)
    {
        if (!$request->input("date")) return response()->json(["alert" => "Nie podano daty!"]);
        $start = Station::where('name', '=', $request->input("start"))->firstOrFail();
        $end = Station::where('name', '=', $request->input("end"))->firstOrFail();
        $description = '';
        if ($request->input('description')) $description = $request->input('description');
            $tour = Tour::create([
                'user_id' => Auth::id(),
                'start_station' =>  $start->id,
                'destination_station' => $end->id,
                'length' => 2 + count($request->input("middle")),
                'description' => $description,
                'is_public' => true,
                'date' => $request->input("date"),
            ]);

        $userStation = UserStation::firstOrCreate(
            ["user_id" => Auth::id(), "station_id" => $start->id],
            [
                "user_id" => Auth::id(),
                "statioin_id" => $start->id,
                "times_passed" => 0,
                "times_visited" => 0,
            ]
        );
        $userStation->times_visited++;
        $userStation->save();
        foreach ($request->input("middle") as &$middle_station) 
        {
            $station = Station::where("name", "=", $middle_station)->firstOrFail();
            TourStation::create([
                'tour_id' => $tour->id,
                'station_id' => $station->id,
            ]);
            $userStation = UserStation::firstOrCreate(["user_id" => Auth::id(), "station_id" => $station->id],
            [
            "user_id" => Auth::id(),
            "statioin_id" => $station->id,
            "times_passed" => 0,
            "times_visited" => 0,
            ]);
            $userStation->times_passed++;
            $userStation->save();
        }

        $userStation = UserStation::firstOrCreate(
            ["user_id" => Auth::id(), "station_id" => $end->id],
            [
                "user_id" => Auth::id(),
                "statioin_id" => $end->id,
                "times_passed" => 0,
                "times_visited" => 0,
            ]
        );
        $userStation->times_visited++;
        $userStation->save();
        
        return response()->json([
            'alert' => "Dodano wycieczkę!",
        ]);
    }
}
