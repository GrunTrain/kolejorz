<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Models\Station;
use Illuminate\Http\Request;

class  StationController extends Controller
{
    public function index()
    {
         return StationResource::collection(Station::all());
    }

    public function store(Request $request)
    {
        $station = Station::updateOrCreate([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);

        return $station;
    }
}