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
		return Socialite::driver('google')->redirect();
	}

	public function callbackToGoogle()
	{
		try {
			$user = Socialite::driver('google')->user();

			$finduser = User::where('email', $user->email)->first();

			if ($finduser) {
				Auth::login($finduser);

				return response()->json(['message'=> 'successfull google authentication'], 201);
			} else {
				$newUser = User::create([
					'name'      => $user->name,
					'email'     => $user->email,
					'gauth_id'  => $user->id,
					'gauth_type'=> 'google',
				]);

				Auth::login($newUser);

				return response()->json(['message'=> 'successfull google registration'], 201);
			}
		} catch (Exception $error) {
			return response()->json(['message'=> $error->getMessage()]);
		}
	}
}
