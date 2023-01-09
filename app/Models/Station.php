<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    public function userStation()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'id',
        'title',
        'lat',
        'lon',
        'status',
        'user_id'
    ];
}
