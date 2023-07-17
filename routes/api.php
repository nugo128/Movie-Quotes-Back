<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryCotroller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NotificationController;
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


Route::middleware('auth:sanctum')->group(function () {
	Route::controller(UserProfileController::class)->group(function () {
		Route::post('/editProfile', 'editProfile');
		Route::get('/verify-new-email/{token}', 'verify');
	});
	Route::get('/user', function (Request $request) {
		return $request->user();
	});
	Route::get('/category', [CategoryCotroller::class, 'index']);

	Route::controller(NotificationController::class)->group(function () {
		Route::get('/get-notifications/{userId}', 'getNotifications');
		Route::post('/read-notifications', 'readNotification');
	});
	Route::controller(MovieController::class)->group(function () {
		Route::get('/movies', 'getMovies');
		Route::post('/add-movie', 'store');
		Route::get('/user-movies', 'userMovies');
		Route::get('/search-movie', 'searchMovies');
		Route::get('/movie-description', 'movieDescription');
		Route::delete('/delete-movie/{movieId}', 'destroy');
		Route::post('/update-movie', 'update');
	});
	Route::controller(QuoteController::class)->group(function () {
		Route::get('/post', 'getPost');
		Route::post('/newPost', 'newPost');
		Route::post('/edit-quote', 'update');
		Route::get('/search-post', 'searchPost');
		Route::get('/view-quote', 'viewQuote');
		Route::delete('/delete-quote/{quoteId}', 'destroy');
	});
	Route::controller(LikeController::class)->group(function () {
		Route::post('/like', 'store');
		Route::post('/get-likes', 'getLikes');
		Route::post('/remove-like', 'destroy');
	});
	Route::post('/comment', [CommentController::class, 'store']);
});


Route::get('auth/google', [GoogleAuthController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleAuthController::class, 'callbackToGoogle']);
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/verify/{token}', [RegistrationController::class, 'verify']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
