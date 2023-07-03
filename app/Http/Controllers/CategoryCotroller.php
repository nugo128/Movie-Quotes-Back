<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryCotroller extends Controller
{
	public function index(): JsonResponse
	{
		$category = CategoryResource::collection(Category::all());
		return response()->json($category, 200);
	}
}
