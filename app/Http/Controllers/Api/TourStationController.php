<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourStationResource;
use App\Models\TourStation;
use Illuminate\Http\Request;

class TourStationController extends Controller
{
    public function show($id){
        return TourStationResource::collection(TourStation::where('tour_id', $id)->get());
    }
}
