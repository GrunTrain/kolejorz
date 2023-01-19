<?php

namespace App\Http\Controllers\Api;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\FriendResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

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

    public function friendsByUserId($id)
    {
        $id = Auth::id();
        $friends = Friend::where('user_id', $id)->get();
        $users = array();
        foreach($friends as $friend)
        {
            array_push($users, User::where("id", $friend->observed_id)->first());
        }
        return UserResource::collection($users);
    }

    public function addFriendToCurrentUser(Request $request){
        $user = User::where('id', Auth::id())->first();
        Friend::create([
            'user_id' => $user->id,
            'observed_id' => $request->input('id'),
        ]);
    }

    public function deleteFriend($id){
        Friend::where(['user_id' => Auth::id(), 'observed_id' => $id])->first()->delete();
    }

    public function store(Request $request){
        $friend = Friend::where('id', $request->input('id'))->first();
        $friend->update([
            'user_id' => $request->input('user_id'),
            'observed_id' => $request->input('observed_id'),
        ]);
    }
}
