<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'             => $this->id,
			'title'          => $this->title,
			'year'           => $this->year,
			'user_id'        => $this->user_id,
			'thumbnail'      => $this->thumbnail,
			'description'    => $this->description,
			'category'       => $this->categories,
			'director'       => $this->director,
			'quote'          => QuoteResource::collection($this->quote()->orderBy('id', 'desc')->get()),
		];
	}
}
