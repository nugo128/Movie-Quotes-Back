<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
	public function getMovies(): JsonResponse
	{
		$movies = MovieResource::collection(Movie::all());
		return response()->json($movies, 200);
	}

	public function userMovies(): JsonResponse
	{
		$user = auth()->user();
		$movies = MovieResource::collection($user->movie);
		return response()->json($movies, 200);
	}
}
