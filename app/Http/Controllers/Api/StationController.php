<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class  StationController extends Controller
{
    public function index()
    {
         return StationResource::collection(Station::all());
    }

    public function show($id)
    {
        $id = Auth::id();

        $station = Station::where('user_id', $id)->get();
        $stationCollection = StationResource::collection($station);

        return $stationCollection;
    }

    public function store(Request $request)
    {
        if (Station::where('id', $request->input('id'))
                    ->where('status', $request->input('status'))
                    ->where('user_id', Auth::id())
                    ->exists()) {
            $status = ($request->input('status'));
            return response()->json([
                'alert' => "Wybrana stacja ma już status - $status",
            ]);
        }
        else {
            Station::updateOrCreate([
                'id' => $request->input('id'),
                'title' => $request->input('title'),
                'lat' => $request->input('lat'),
                'lon' => $request->input('lon'),
                'status' => $request->input('status'),
                'user_id' => Auth::id()
            ]);
            return response()->json([
                'alert' => "Dodano do Moich stacji!",
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $station = Station::where('id', $id)
            ->where('status', $request->input('status'))
            ->where('user_id', Auth::id());

        $station->delete();
    }
}
