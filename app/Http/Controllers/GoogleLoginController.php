<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if a user with this Google ID already exists
        $existingUser = User::where('google_id', $googleUser->id)->first();

        if ($existingUser) {
            // Log in the existing user.
            auth()->login($existingUser, true);
        } else {
            // Check if a user with the same email already exists
            $userByEmail = User::where('email', $googleUser->email)->first();

            if ($userByEmail) {
                // Update this user with the Google ID
                $userByEmail->google_id = $googleUser->id;
                $userByEmail->save();

                // Log in the user
                auth()->login($userByEmail, true);
            } else {
                // Create a new user
                $newUser = new User();
                $newUser->name = $googleUser->name;
                $newUser->email = $googleUser->email;
                $newUser->google_id = $googleUser->id;
                $newUser->password = bcrypt(Str::random(16)); // Set a random password
                $newUser->save();

                // Log in the new user
                auth()->login($newUser, true);
            }
        }

        // Redirect to the intended URL, or default to /dashboard
        return redirect()->intended('/dashboard');
    }
}
