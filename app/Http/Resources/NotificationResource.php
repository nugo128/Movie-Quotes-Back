<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$from = User::where('id', $this->user_id)->get();
		return [
			'id'                          => $this->id,
			'from'                        => UserResource::make($this->user)->name,
			'user_id'                     => UserResource::make($this->user)->id,
			'picture'                     => UserResource::make($this->user)->profile_picture,
			'type'                        => $this->type,
			'to'                          => $this->user_to_notify,
			'createdAt'                   => $this->created_at,
		];
	}
}
