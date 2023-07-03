<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'id'             => 'required|exists:movies,id',
			'title_ka'       => 'regex:/^[ა-ჰ.,!?\s]*$/|max:255',
			'title_en'       => 'regex:/^[a-zA-Z0-9\s]+$/|max:255',
			'description_ka' => 'regex:/^[ა-ჰ.,!?\s]+$/',
			'description_en' => 'regex:/^[a-zA-Z0-9\s]+$/',
			'director_ka'    => 'regex:/^[ა-ჰ.,!?\s]+$/|max:255',
			'director_en'    => 'regex:/^[a-zA-Z0-9\s]+$/|max:255',
			'year'           => 'numeric',
			'image'          => 'image',
		];
	}
}
