<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Events\LikeNotification;
use App\Events\RemoveLike;
use App\Http\Requests\LikeRequest;
use App\Models\Like;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
	public function store(LikeRequest $request): JsonResponse
	{
		$like = Like::create([
			'user_id'   => auth()->id(),
			'quote_id'  => $request['quote_id'],
			'created_at'=> now(),
		]);
		$notification = (object)[
			'to'        => $request['user_id'],
			'type'      => 'like',
			'from'      => auth('sanctum')->user()->name,
			'user_id'   => auth()->id(),
			'picture'   => auth('sanctum')->user()->profile_picture,
		];
		event(new LikeEvent($like));
		event(new LikeNotification($notification));
		return response()->json(['message'=> 'Post liked', 'like'=>$like], 200);
	}

	public function getLikes(LikeRequest $request): JsonResponse
	{
		$like = Like::where('user_id', auth()->id())->where('quote_id', $request['quote_id'])->first();

		if ($like) {
			return response()->json(['message'=> 'user already has a like', 'like'=>$like], 200);
		}
		return response()->json(['message'=> 'user does not have a like'], 201);
	}

	public function destroy(LikeRequest $request): JsonResponse
	{
		$like = Like::where('user_id', auth()->id())->where('quote_id', $request['quote_id'])->first();

		if ($like) {
			event(new RemoveLike($like));
			$like->delete();
			return response()->json(['message' => 'Like deleted successfully'], 200);
		}
	}
}
