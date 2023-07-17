<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
	public function login(LoginRequest $request): JsonResponse
	{
		$attributes = $request->validated();
		$fieldType = filter_var($attributes['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
		if (auth()->attempt([$fieldType => $attributes['username'], 'password' => $attributes['password']], request()->get('remember_me'))) {
			request()->session()->regenerate();
			return response()->json(['message'=> 'logged in'], 201);
		}

		return response()->json(['message'=> [
			'en'=> 'invalid credentials',
			'ka'=> 'მონაცემები არასწორია',
		]], 404);
	}

	public function logout(): JsonResponse
	{
		auth()->logout();
		return response()->json(['message'=> 'user logged out'], 200);
	}
}
