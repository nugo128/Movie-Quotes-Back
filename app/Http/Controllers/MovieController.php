<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieDescriptionRequest;
use App\Http\Requests\MovieRequest;
use App\Http\Requests\MovieSearchRequest;
use App\Http\Requests\MovieUpdateRequest;
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

	public function searchMovies(MovieSearchRequest $request): JsonResponse
	{
		$search = $request->search;
		$user = auth()->user();
		$movies = MovieResource::collection($user->movie()->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(title, '$.\"en\"'))) LIKE ?", ['%' . strtolower($search) . '%'])->orWhere('title->ka', 'like', '%' . strtolower($search) . '%')->orderByDesc('id')->get());

		return response()->json($movies, 200);
	}

	public function userMovies(): JsonResponse
	{
		$user = auth()->user();
		$movies = MovieResource::collection($user->movie()->orderByDesc('id')->get());
		return response()->json($movies, 200);
	}

	public function movieDescription(MovieDescriptionRequest $request): JsonResponse
	{
		$id = $request->id;
		$movie = new MovieResource(Movie::find($id));
		return response()->json($movie, 200);
	}

	public function update(MovieUpdateRequest $request): JsonResponse
	{
		$id = $request->input('id');
		$movie = Movie::where('id', $id)->first();
		if ($request->has('title_en')) {
			$title_ka = json_decode($movie->title)->ka;
			$titles = [
				'ka' => $title_ka,
				'en' => $request->input('title_en'),
			];
			$movie->title = json_encode($titles);
		}
		if ($request->has('title_ka')) {
			$title_en = json_decode($movie->title)->en;
			$titles = [
				'en' => $title_en,
				'ka' => $request->input('title_ka'),
			];
			$movie->title = json_encode($titles);
		}
		if ($request->has('director_ka')) {
			$director_en = json_decode($movie->director)->en;
			$directors = [
				'en' => $director_en,
				'ka' => $request->input('director_ka'),
			];
			$movie->director = json_encode($directors);
		}
		if ($request->has('director_en')) {
			$director_ka = json_decode($movie->director)->ka;
			$directors = [
				'en' => $request->input('director_en'),
				'ka' => $director_ka,
			];
			$movie->director = json_encode($directors);
		}
		if ($request->has('description_en')) {
			$description_ka = json_decode($movie->description)->ka;
			$descriptions = [
				'en' => $request->input('description_en'),
				'ka' => $description_ka,
			];
			$movie->description = json_encode($descriptions);
		}
		if ($request->has('description_ka')) {
			$description_en = json_decode($movie->description)->en;
			$descriptions = [
				'en' => $description_en,
				'ka' => $request->input('description_ka'),
			];
			$movie->description = json_encode($descriptions);
		}
		if ($request->file('image')) {
			$movie->thumbnail = $request->file('image')->store('images');
		}
		if ($request->has('year')) {
			$movie->year = $request->input('year');
		}
		if ($request->categories) {
			$this->addGenres($movie, $request->categories);
		}
		$movie->save();
		return response()->json($movie, 200);
	}

	public function destroy($movieId): JsonResponse
	{
		$movie = Movie::find($movieId);

		if (!$movie) {
			return response()->json(['error' => ['en'=>'Movie not found', 'ka'=>'ფილმი არ მოიძებნა']], 404);
		}

		$movie->delete();

		return response()->json(['message' => 'Movie deleted successfully']);
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
