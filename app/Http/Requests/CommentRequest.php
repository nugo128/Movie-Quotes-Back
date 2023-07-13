<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
			'quote_id'   => 'required',
			'comment'    => 'required',
			'user_id'    => 'required',
			'post_author'=> 'required',
		];
	}

	public function messages()
	{
		return [
			'quote_id.required'=> [
				'en'=> 'quote ID is required',
				'ka'=> 'ციტატის ID სავალდებულოა',
			],
			'user_id.required'=> [
				'en'=> 'user ID is required',
				'ka'=> 'მომხმარებლის ID სავალდებულოა',
			],
			'comment.required'=> [
				'en'=> 'comment is required',
				'ka'=> 'კომენტარი სავალდებულოა',
			],
			'post_author.required'=> [
				'en'=> 'post author is required',
				'ka'=> 'პოსტის ავტორი სავალდებულოა',
			],
		];
	}
}
