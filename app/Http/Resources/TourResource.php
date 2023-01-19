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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'start_station' => $this->start_station,
            'destination_station' => $this->destination_station,
            'length' => $this->length,
            'description' => $this->description,
            'data' => $this->data,
            'date' => $this->date
        ];
    }
}
