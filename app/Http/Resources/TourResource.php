<?php

namespace App\Http\Resources;

use App\Models\Station;
use App\Models\Tour;
use App\Models\TourStation;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
//            'stations' => TourStation::where('tour_id', $this->id)->get('station_id'),

            'start_station' => Station::where('id', $this->start_station)->firstOrFail()->name,
            'destination_station' => Station::where('id', $this->destination_station)->firstOrFail()->name,
            'length' => $this->length,
            'description' => $this->description,
        ];
    }
}
