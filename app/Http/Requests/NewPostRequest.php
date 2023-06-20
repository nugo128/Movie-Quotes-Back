<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPostRequest extends FormRequest
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
			'quote_ka' => 'required|regex:/^[ა-ჰ.,!?\s]*$/',
			'quote_en' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
			'movie_id' => 'required|exists:movies,id',
			'image'    => 'image',
		];
	}
}
