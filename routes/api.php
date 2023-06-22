<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryCotroller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/editProfile', [UserProfileController::class, 'editProfile']);
Route::get('/verify-new-email/{token}', [UserProfileController::class, 'verify']);

Route::get('/category', [CategoryCotroller::class, 'index']);

Route::get('/post', [QuoteController::class, 'getPost']);
Route::post('/newPost', [QuoteController::class, 'newPost']);
Route::get('/search-post', [QuoteController::class, 'searchPost']);
Route::get('/movies', [MovieController::class, 'getMovies']);
Route::get('/user-movies', [MovieController::class, 'userMovies']);
Route::post('/like', [LikeController::class, 'store']);
Route::post('/get-likes', [LikeController::class, 'getLikes']);
Route::post('/remove-like', [LikeController::class, 'destroy']);
Route::post('/comment', [CommentController::class, 'store']);

Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/verify/{token}', [RegistrationController::class, 'verify']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

Route::get('auth/google', [GoogleAuthController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleAuthController::class, 'callbackToGoogle']);
