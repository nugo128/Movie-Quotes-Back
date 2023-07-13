<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'token'    => 'required|exists:users,reset_token',
			'password' => 'required|min:8|max:15|confirmed|regex:/^[a-z0-9]+$/',
		];
	}

	public function messages()
	{
		return [
			'token.exists'=> [
				'en'=> 'token not found',
				'ka'=> 'ტოკენი არ მოიძებნა',
			],
		];
	}
}
