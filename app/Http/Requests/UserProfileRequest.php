<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'username' => 'min:3|max:15|regex:/^[a-zA-Z0-9\s]+$/',
			'email'    => 'email|max:255',
			'password' => 'min:8|max:15|confirmed|regex:/^[a-z0-9]+$/',
			'image'    => 'image',
		];
	}
}
