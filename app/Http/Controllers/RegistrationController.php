<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Mail\ConfirmationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
	public function register(RegistrationRequest $request)
	{
		$validatedData = $request->validated();
		$user = User::create([
			'name'     => $validatedData['name'],
			'email'    => $validatedData['email'],
			'password' => bcrypt($validatedData['password']),
		]);
		auth()->login($user);

		// Mail::to($user->email)->send(new ConfirmationMail($user));

		return response()->json(['message'=> 'registered'], 201);
	}
}
