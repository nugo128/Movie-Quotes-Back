<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\RegistrationController;
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
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/verify/{token}', [RegistrationController::class, 'verify']);

Route::get('auth/google', [GoogleAuthController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleAuthController::class, 'callbackToGoogle']);
