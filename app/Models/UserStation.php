<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'station_id',
        'times_visited',
        'times_passed',
    ];
}
