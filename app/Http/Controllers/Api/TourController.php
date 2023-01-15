<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TourResource;
use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\Tour;
use App\Models\TourStation;
use App\Models\UserStation;

class TourController extends Controller
{
    public function store(Request $request)
    {

        $start = Station::where('name', $request->input('data.start'))->firstOrFail();
        $end = Station::where('name', $request->input('data.end'))->firstOrFail();
        $middle = $request->input('data.middle');

        $date = $request->input('data.date');
        $description = $request->input('data.description');
        $isPublic = ($description != '' ? true : false);

        //create tour
        $tour = Tour::create([
            'user_id' => Auth::id(),
            'start_station' => $start->id,
            'destination_station' => $end->id,
            'length' => 2 + count($middle),
            'description' => $description,
            'is_public' => $isPublic,
            'date' => $date,
        ]);

        //first station
        $userStation = UserStation::firstOrCreate(
            [
                "user_id" => Auth::id(),
                "station_id" => $start->id
            ],
            [
                "user_id" => Auth::id(),
                "station_id" => $start->id,
                "times_passed" => 0,
                "times_visited" => 0,
            ]
        );
        $userStation->times_visited++;
        $userStation->save();


        //middle stations
        foreach ($middle as &$middleStation)
        {
            $station = Station::where("name", $middleStation)->firstOrFail();
            TourStation::create([
                'tour_id' => $tour->id,
                'station_id' => $station->id,
            ]);
            $userStation = UserStation::firstOrCreate(
                [
                    "user_id" => Auth::id(),
                    "station_id" => $station->id
                ],
                [
                    "user_id" => Auth::id(),
                    "station_id" => $station->id,
                    "times_passed" => 0,
                    "times_visited" => 0,
                ]);

            $userStation->times_passed++;
            $userStation->save();
        }

        //end station
        $userStation = UserStation::firstOrCreate(
            [
                "user_id" => Auth::id(),
                "station_id" => $end->id
            ],
            [
                "user_id" => Auth::id(),
                "station_id" => $end->id,
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
    public function index(Request $request)
    {
        return TourResource::collection(Tour::all());
    }
    public function destroy($id)
    {
        $tour = Tour::where('id', $id)->first();
        $tour_stations = TourStation::where('tour_id', $tour->id)->get();
        foreach($tour_stations as $tour_station)
        {
            $user_stations = UserStation::where('station_id', $tour_station->station_id)->get();
            foreach($user_stations as $user_station)
            {
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

    public function statistics()
    {
        $tours = Tour::where('user_id', Auth::id())->get();
        $user_tours = $tours->count();
        $len_min = $tours->first()->length;
        $len_max = $tours->first()->length;
        $len_mean = 0;
        $public_tours = 0;

        foreach ($tours as $tour) {
            $len_mean += $tour->length;
            $len_min = min($len_min, $tour->length);
            $len_max = max($len_max, $tour->length);
            if ($tour->is_public) $public_tours++;
        }
        $len_mean /= $user_tours;

        return response()->json([
            'user_tours' => $user_tours,
            'len_min' => $len_min,
            'len_max' => $len_max,
            'len_mean' => (int)$len_mean,
            'public_tours' => $public_tours,
        ]);
    }
}
