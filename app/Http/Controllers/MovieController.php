<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
	public function getMovies(): JsonResponse
	{
		$movies = Movie::all();
		return response()->json($movies, 200);
	}
}
