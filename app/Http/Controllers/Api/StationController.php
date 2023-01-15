<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\Tour;
use App\Models\TourStation;
use App\Models\UserStation;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $stations = Station::all();
        return StationResource::collection($stations);
    }

    public function destroy($id)
    {
        $station = Station::where('id', $id)->first();
        $tours = Tour::where('start_station', $station->id)->get();
        foreach ($tours as $tour) {
            $tour_stations = TourStation::where('tour_id', $tour->id)->get();
            foreach ($tour_stations as $tour_station) {
                $user_stations = UserStation::where('station_id', $tour_station->station_id)->get();
                foreach ($user_stations as $user_station) {
                    $user_station->times_passed--;
                    $user_station->save();
                }
                $tour_station->delete();
            }
            $user_station = UserStation::where('station_id', $tour->start_station)->first();
            $user_station->times_visited--;
            $user_station->save();
            $user_station = UserStation::where('station_id', $tour->destination_station)->first();
            $user_station->times_visited--;
            $user_station->save();
            $tour->delete();
        }
        $tours = Tour::where('destination_station', $station->id)->get();
        foreach ($tours as $tour) {
            $tour_stations = TourStation::where('tour_id', $tour->id)->get();
            foreach ($tour_stations as $tour_station) {
                $user_stations = UserStation::where('station_id', $tour_station->station_id)->get();
                foreach ($user_stations as $user_station) {
                    $user_station->times_passed--;
                    $user_station->save();
                }
                $tour_station->delete();
            }
            $user_station = UserStation::where('station_id', $tour->start_station)->first();
            $user_station->times_visited--;
            $user_station->save();
            $user_station = UserStation::where('station_id', $tour->destination_station)->first();
            $user_station->times_visited--;
            $user_station->save();
            $tour->delete();
        }
        $user_stations = UserStation::where('station_id', $station->id)->get();
        foreach($user_stations as $user_station)
        {
            $user_station->delete();
        }
        $station->delete();
    }
}
