<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Mail\ChangeEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\NewEmail;

class UserProfileController extends Controller
{
	public function editProfile(UserProfileRequest $request): JsonResponse
	{
		$attributes = $request->validated();
		$user = User::where('id', auth()->id())->first();
		if ($request->file('image')) {
			$user->profile_picture = $request->file('image')->store('images');
		}
		if ($request->has('username')) {
			$user->name = $attributes['username'];
		}
		if ($request->has('password')) {
			$user->password = bcrypt($attributes['password']);
		}
		if ($request->has('email')) {
			$token = Str::random(128);
			$newEmail = new NewEmail();
			$newEmail->user_id = auth()->id();
			$newEmail->email = $attributes['email'];
			$newEmail->verification_token = $token;
			$user->email = $attributes['email'];
			$user->verification_token = $token;
			Mail::to($attributes['email'])->send(new ChangeEmail($user));
			$newEmail->save();
		}
		$user->save();
		return response()->json($user['profile_picture'], 200);
	}

	public function verify($mail): JsonResponse
	{
		$emailChange = NewEmail::where('email', $mail)->first();
		$user = User::where('id', auth()->id())->first();
		if (!$emailChange || !$user) {
			return response()->json(['error' => 'Invalid token or user not found'], 404);
		}
		$user->update([
			'email'             => $emailChange->email,
			'email_verified_at' => now(),
			'updated_at'        => now(),
		]);
		$emailChange->delete();

		return response()->json(['message'=>'verified'], 200);
	}
}
