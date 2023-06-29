<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuoteRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'id'             => 'required|exists:quotes,id',
			'quote_ka'       => 'regex:/^[ა-ჰ.,!?\s]*$/|max:255',
			'quote_en'       => 'regex:/^[a-zA-Z0-9\s]+$/|max:255',
			'image'          => 'image',
		];
	}
}
