<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'                 => $this->id,
			'quote'              => $this->quote,
			'like'               => $this->like,
			'comment'            => $this->comment,
			'thumbnail'          => $this->thumbnail,
			'user'               => UserResource::make($this->user),
		];
	}
}
