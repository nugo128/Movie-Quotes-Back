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

		$user = new User();
		$user->name = $validatedData['name'];
		$user->email = $validatedData['email'];
		$user->password = bcrypt($validatedData['password']);

		Mail::to($user->email)->send(new ConfirmationMail($user));

		return response()->json(['message' => 'Registration successful'], 201);
	}
}
