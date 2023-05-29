<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

		return response()->json(['message' => 'Registration successful'], 201);
	}
}
