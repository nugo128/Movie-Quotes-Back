<?php

namespace App\Http\Controllers;

use App\Events\AddComment;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
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

		event(new AddComment(CommentResource::make($comment)));

		return response()->json(['message'=> 'comment added', 'comment'=>$attributes], 201);
	}
}
