<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'station_id',
    ];
}
