<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Tour;
use App\Models\TourStation;
use App\Models\UserStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function update(Request $request, $id)
    {
        $id = Auth::id();

        $name = $request->input('data.name');
        $password = bcrypt($request->input('data.password'));

        if ($name) {
            User::where('id', $id)->update([
                'name' => $name
            ]);
        }
        if ($password) {
            User::where('id', $id)->update([
                'password' => $password
            ]);
        }
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $tours = Tour::where('user_id', $id)->get();
        foreach($tours as $tour)
        {
            $tour_stations = TourStation::where('tour_id', $tour->id)->get();
            foreach ($tour_stations as $tour_station) {
                $tour_station->delete();
            }
            $tour->delete();
        }
        $user_stations = UserStation::where('user_id', $id)->get();
        foreach($user_stations as $user_station)
        {
            $user_station->delete();
        }
        $user->delete();
    }
    public function activeUser()
    {
        return UserResource::make(User::where('id', Auth::id())->first());
    }
}
