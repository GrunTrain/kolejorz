<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user1_id',
        'user2_id',
    ];

    public static function checkReverseOrder(int $user1Id, int $user2Id)
    {
        $isInReverse = Friend::where('user1_id', $user2Id)->
                               where('user2_id', $user1Id)->firstOr(function() 
        {
            return false;
        });
        return $isInReverse;
    }
}