<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
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
}
