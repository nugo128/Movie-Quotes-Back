<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPostRequest;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
	public function getPost(): JsonResponse
	{
		$quotes = Quote::with('user', 'movie', 'like', 'comment.user')->orderBy('id', 'desc')->get();
		return response()->json($quotes, 200);
	}

	public function newPost(NewPostRequest $request): JsonResponse
	{
		$quotes = [
			'en' => $request->input('quote_en'),
			'ka' => $request->input('quote_ka'),
		];
		$quote = Quote::create([
			'quote'     => json_encode($quotes),
			'movie_id'  => $request->validated()['movie_id'],
			'thumbnail' => $request->file('image')->store('images'),
			'user_id'   => auth()->id(),
		]);
		$quote->save();
		return response()->json(['message'=> asset('storage/' . $quote['thumbnail'])], 200);
	}
}
