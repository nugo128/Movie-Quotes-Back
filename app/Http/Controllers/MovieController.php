<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
	public function store(MovieRequest $request): JsonResponse
	{
		$titles = [
			'en' => $request->input('title_en'),
			'ka' => $request->input('title_ka'),
		];
		$director = [
			'en' => $request['director_en'],
			'ka' => $request['director_ka'],
		];
		$description = [
			'en' => $request->input('description_en'),
			'ka' => $request->input('description_ka'),
		];

		$movie = Movie::create([
			'title'        => json_encode($titles),
			'director'     => json_encode($director),
			'description'  => json_encode($description),
			'year'         => $request->validated()['year'],
			'thumbnail'    => $request->file('image')->store('images'),
			'user_id'      => auth()->id(),
		]);
		if ($request->categories) {
			$this->addGenres($movie, $request->categories);
		}
		$movie->save();
		return response()->json($movie, 200);
	}

	public function getMovies(): JsonResponse
	{
		$movies = MovieResource::collection(Movie::all());
		return response()->json($movies, 200);
	}

	public function userMovies(): JsonResponse
	{
		$user = auth()->user();
		$movies = MovieResource::collection($user->movie()->orderByDesc('id')->get());
		return response()->json($movies, 200);
	}

	private function addGenres(Model $movie, $categories)
	{
		$ids = [];
		$categories = json_decode($categories);
		foreach ($categories as $category) {
			array_push($ids, $category->id);
		}
		$movie->categories()->sync($ids);
	}
}
