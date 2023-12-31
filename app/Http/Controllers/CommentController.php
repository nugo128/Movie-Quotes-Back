<?php

namespace App\Http\Controllers;

use App\Events\AddComment;
use App\Events\CommentNotification;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Notifications;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
	public function store(CommentRequest $request): JsonResponse
	{
		$attributes = $request->validated();
		$comment = Comment::create([
			'quote_id'  => $request['quote_id'],
			'comments'  => $request['comment'],
			'created_at'=> now(),
			'user_id'   => $request['user_id'],
		]);

		if (auth()->id() !== $request['post_author']) {
			Notifications::create([
				'user_id'               => auth()->id(),
				'user_to_notify'        => $request['post_author'],
				'type'                  => 'comment',
				'seen_by_user'          => false,
			]);
		}

		$notification = (object)[
			'to'          => $request['post_author'],
			'type'        => 'comment',
			'from'        => auth('sanctum')->user()->name,
			'user_id'     => auth()->id(),
			'createdAt'   => now(),
			'picture'     => auth('sanctum')->user()->profile_picture,
		];

		event(new AddComment(CommentResource::make($comment)));
		event(new CommentNotification($notification));

		return response()->json(['message'=> 'comment added', 'comment'=>$attributes], 201);
	}
}
