<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotePostResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'            => $this->id,
			'quote'         => $this->quote,
			'thumbnail'     => $this->thumbnail,
			'movie'         => MovieResource::make($this->movie),
			'user'          => UserResource::make($this->user),
			'comments'      => CommentResource::collection($this->comment),
			'likes'         => LikeResource::collection($this->like),
		];
	}
}
