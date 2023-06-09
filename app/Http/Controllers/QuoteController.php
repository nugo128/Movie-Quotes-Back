<?php

namespace App\Http\Controllers;

use App\Models\Quote;

class QuoteController extends Controller
{
	public function getPost()
	{
		$quotes = Quote::with('user', 'movie', 'like', 'comment.user')->orderBy('id', 'desc')->get();
		return response()->json($quotes, 200);
	}
}
