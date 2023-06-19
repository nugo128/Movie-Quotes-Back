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
			$user->verification_token = $token;
			Mail::to($attributes['email'])->send(new ChangeEmail($user));
			$newEmail->save();
		}
		$user->save();
		return response()->json($user['profile_picture'], 200);
	}

	public function verify($token): JsonResponse
	{
		$emailChange = NewEmail::where('verification_token', $token)->first();
		$user = User::where('id', auth()->id())->first();
		$user->email = $emailChange->email;
		$user->email_verified_at = now();
		$user->updated_at = now();
		$user->save();
		$emailChange->delete();

		return response()->json(['message'=>'verified'], 200);
	}
}
