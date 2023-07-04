<?php

namespace App\Http\Controllers;

use App\Events\AddComment;
use App\Events\CommentNotification;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\User;
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
		$user = User::where('id', $request['user_id'])->first();
		$notification = (object)[
			'to'        => $request['post_author'],
			'type'      => 'comment',
			'from'      => auth('sanctum')->user()->name,
			'user_id'   => auth()->id(),
			'picture'   => $user->profile_picture,
		];

		event(new AddComment(CommentResource::make($comment)));
		event(new CommentNotification($notification));

		return response()->json(['message'=> 'comment added', 'comment'=>$attributes], 201);
	}
}
