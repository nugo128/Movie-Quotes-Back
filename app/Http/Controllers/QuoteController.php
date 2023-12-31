<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPostRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Requests\ViewQuoteRequest;
use App\Http\Resources\QuotePostResource;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
	public function getPost(): JsonResponse
	{
		$quotes = QuotePostResource::collection(Quote::orderByDesc('id')->get());
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

	public function searchPost(SearchRequest $request): JsonResponse
	{
		if (strpos($request->search, '#') === 0) {
			$search = ltrim($request->search, $request->search[0]);
			$quote = QuotePostResource::collection(Quote::with('user', 'movie', 'like', 'comment.user')->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(quote, '$.\"en\"'))) LIKE ?", ['%' . strtolower($search) . '%'])->orWhere('quote->ka', 'like', '%' . $search . '%')->orderByDesc('id')->get());
		} elseif (strpos($request->search, '@') === 0) {
			$search = ltrim($request->search, $request->search[0]);
			$quote = QuotePostResource::collection(Quote::with('user', 'movie', 'like', 'comment.user')
			->whereHas('movie', function ($query) use ($search) {
				$query->where('title', 'like', '%' . $search . '%');
			})->orderByDesc('id')
			->get());
		} else {
			$search = $request->search;
			$quote = QuotePostResource::collection(Quote::with('user', 'movie', 'like', 'comment.user')
				->where(function ($query) use ($search) {
					$query->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(quote, '$.\"en\"'))) LIKE ?", ['%' . strtolower($search) . '%'])
						->orWhere('quote->ka', 'like', '%' . $search . '%');
				})
				->orWhereHas('movie', function ($query) use ($search) {
					$query->where('title', 'like', '%' . $search . '%');
				})->orderByDesc('id')
				->get());
		}
		return response()->json($quote, 200);
	}

	public function destroy($quoteId): JsonResponse
	{
		$quote = Quote::find($quoteId);

		if (!$quote) {
			return response()->json(['error' => ['en'=> 'Quote not found', 'ka'=>'ციტატა არ მოიძებნა']], 404);
		}

		$quote->delete();

		return response()->json(['message' => 'Quote deleted successfully']);
	}

	public function viewQuote(ViewQuoteRequest $request): JsonResponse
	{
		$id = $request->id;
		$quotes = new QuotePostResource(Quote::find($id));
		return response()->json($quotes, 200);
	}

	public function update(UpdateQuoteRequest $request): JsonResponse
	{
		$id = $request->input('id');
		$quote = Quote::where('id', $id)->first();
		if ($request->has('quote_en')) {
			$quote_ka = json_decode($quote->quote)->ka;
			$quotes = [
				'ka' => $quote_ka,
				'en' => $request->input('quote_en'),
			];
			$quote->quote = json_encode($quotes);
		}
		if ($request->has('quote_ka')) {
			$quote_en = json_decode($quote->quote)->en;
			$quotes = [
				'ka' => $request->input('quote_ka'),
				'en' => $quote_en,
			];
			$quote->quote = json_encode($quotes);
		}
		if ($request->file('image')) {
			$quote->thumbnail = $request->file('image')->store('images');
		}
		$quote->save();

		return response()->json($quote, 200);
	}
}
