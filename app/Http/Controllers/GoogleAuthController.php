<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
	public function signInwithGoogle()
	{
		$redirectUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
		return response()->json(['message'=> $redirectUrl]);
	}

	public function callbackToGoogle()
	{
		try {
			$user = Socialite::driver('google')->stateless()->user();

			$finduser = User::where('email', $user->email)->first();

			if ($finduser) {
				Auth::login($finduser);

				return redirect(env('FRONTEND_URL') . '/newsfeed');
			} else {
				$newUser = User::create([
					'name'      => $user->name,
					'email'     => $user->email,
					'gauth_id'  => $user->id,
					'gauth_type'=> 'google',
				]);

				Auth::login($newUser);

				return redirect(env('FRONTEND_URL') . '/newsfeed');
			}
		} catch (Exception $error) {
			return response()->json(['message'=> $error->getMessage()]);
		}
	}
}
