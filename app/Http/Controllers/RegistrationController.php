<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Mail\ConfirmationMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
	public function register(RegistrationRequest $request): JsonResponse
	{
		$validatedData = $request->validated();
		$user = User::create([
			'name'               => $validatedData['name'],
			'email'              => $validatedData['email'],
			'password'           => bcrypt($validatedData['password']),
			'verification_token' => Str::random(128),
		]);

		Mail::to($user->email)->send(new ConfirmationMail($user));

		return response()->json(['message'=> 'registered'], 201);
	}

	public function verify($token)
	{
		$user = User::where('verification_token', $token)->firstOrFail();
		if (!is_null($user)) {
			$user->email_verified_at = now();
			$user->save();
			auth()->login($user);
			return response()->json(['message'=> 'verified!'], 201);
		}
		return response()->json(['message'=> 'verification failed'], 419);
	}
}
