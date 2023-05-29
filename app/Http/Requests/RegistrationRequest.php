<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
			'name'                  => 'required|min:3|max:15|unique:users',
			'email'                 => 'required|email|max:255|unique:users',
			'password'              => 'required|min:8|max:15|confirmed',
		];
	}
}
