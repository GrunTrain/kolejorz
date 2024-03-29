<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function githubRedirect()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    public function githubCallback(Request $request)
    {
        $user = Socialite::driver('github')->stateless()->user();
        $this->createOrUpdateUser($user, 'github');
        return Redirect::to('http://localhost/');
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googleCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        $data = User::where('email', $user->email)->first();
        if(is_null($data)) {
            $users['name'] = $user->name;
            $users['email'] = $user->email;
            $users['password'] = '$2y$10$92IXUNpkjO0rOQdd5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
            $data = User::create($users);
        }
        Auth::login($data);
        return Redirect::to('http://localhost/');
    }

    public function createOrUpdateUser($data, $provider) {
        $user = User::where('email', $data->email)->first();

        if($user) {
            $user -> update([
                'password' => '$2y$10$92IXUNpkjO0rOQdd5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ]);
        } else {
            $user = User::create([
                    'name'=>$data->nickname,
                    'email'=>$data->email,
                    'password' => '$2y$10$92IXUNpkjO0rOQdd5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ]);
        }

        Auth::login($user);
    }
}
