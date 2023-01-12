<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_station',
        'destination_station',
        'length',
        'description',
        'is_public',
        'date',
    ];
}
