<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'title_ka'       => 'required|regex:/^[ა-ჰ.,!?\s]*$/|max:255',
			'title_en'       => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:255',
			'categories'     => 'required',
			'description_ka' => 'required|regex:/^[ა-ჰ.,!?\s]+$/|max:255',
			'description_en' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:255',
			'director_ka'    => 'required|regex:/^[ა-ჰ.,!?\s]+$/',
			'director_en'    => 'required|regex:/^[a-zA-Z0-9\s]+$/',
			'year'           => 'required|numeric',
			'image'          => 'required|image',
		];
	}
}
