<?php

namespace App\Http\Controllers\Api;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\TourStation;

class TourController extends Controller
{
    public function store(Request $request)
    {
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
        foreach ($request->input("middle") as &$middle_station) 
        {
            $station = Station::where("name", "=", $middle_station)->firstOrFail();
            TourStation::create([
                'tour_id' => $tour->id,
                'station_id' => $station->id,
            ]);
        }
        return response()->json([
            'alert' => "Dodano wycieczkę!",
        ]);
    }
}
