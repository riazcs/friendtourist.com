<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon;
use Inertia\Inertia;

class SocialLoginController extends Controller
{
    //

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::with('google')->stateless()->user();

        if (!empty($user)) {
            $user_check = User::where('email', $user->email)->first();
            if (empty($user_check)) {
                $save_user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_photo_path' => $user->avatar_original,
                    'user_type' => User::Roles['User'],
                    'base' => "google",
                    'base_id' => $user->id,
                    'email_verified_at' => \Carbon\Carbon::now(),
                ]);
                Auth::login($save_user , true);
                return redirect()->route('google.phone');
            }
            else {
                if(empty($user_check->phone)){
                    Auth::login($user_check , true);
                    return redirect()->route('google.phone');
                }
                else {
                    Auth::login($user_check , true);
                    return redirect('/');
                }
            }
        }
        else {
            return redirect('login');
        }

    }
    public function googlePhone(Request $request){
        return Inertia::render('Auth/PhoneVerification');
    }
}
