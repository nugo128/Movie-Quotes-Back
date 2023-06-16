<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'       => $this->id,
			'comment'  => $this->comments,
			'user'     => UserResource::make($this->user),
			'quote_id' => QuoteResource::make($this->quote)->id,
		];
	}
}
