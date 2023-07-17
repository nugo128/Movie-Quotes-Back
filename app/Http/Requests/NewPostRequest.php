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
			'quote_ka' => 'required|regex:/^[ა-ჰ0-9.,!?\s]*$/',
			'quote_en' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
			'movie_id' => 'required|exists:movies,id',
			'image'    => 'image',
		];
	}

	public function messages()
	{
		return [
			'quote_ka.regex' => [
				'en' => 'only Georgian letters and numbers allowed',
				'ka' => 'დასაშვებია მხოლოდ ქართული ასოები და ციფრები',
			],
			'quote_ka.required' => [
				'en' => 'quote in georgian is required',
				'ka' => 'ციტატა ქართულად აუცილებელია',
			],
			'quote_en.regex' => [
				'en' => 'only English letters and numbers allowed',
				'ka' => 'დასაშვებია მხოლოდ ინგლისური ასოები და ციფრები',
			],
			'quote_en.required' => [
				'en' => 'quote in english is required',
				'ka' => 'ციტატა ინგლისურად აუცილებელია',
			],
			'movie_id.required'=> [
				'en'=> 'movie ID is required',
				'ka'=> 'ფილმის ID სავალდებულოა',
			],
		];
	}
}
