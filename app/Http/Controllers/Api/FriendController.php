<?php

namespace App\Http\Controllers\Api;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Resources\FriendResource;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    public function destroy($id)
    {
        Friend::where('id', $id)->first()->delete();
    }

    public function index()
    {
        return FriendResource::collection(Friend::all());
    }
}
