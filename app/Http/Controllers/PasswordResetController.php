<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
	public function sendResetLinkEmail(ForgotPasswordRequest $request): JsonResponse
	{
		$email = $request->validated()['email'];
		$user = User::where('email', $email)->first();
		$token = Str::random(128);

		$user->reset_token = $token;
		$user->save();
		Mail::to($email)->send(new PasswordResetMail($user));

		return response()->json(['message'=> 'email sent'], 200);
	}
}
