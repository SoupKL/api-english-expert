<?php

use App\Http\Controllers\CourseStatusController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ParamanentData\CursePageDataController;
use App\Http\Controllers\UserLoginController;
use App\Mail\FeedbackUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegistratController;

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

Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
	return $request->user();
});

Route::post('/register', [UserRegistratController::class, 'create']);
Route::post('/login', [UserLoginController::class, 'login']);
Route::post('/logout', [UserLoginController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function() {
	Route::get('/users/{user}/course-status', [CourseStatusController::class, 'show']);
	Route::patch('/course-status/{user}', [CourseStatusController::class, 'updateCourse']);

	Route::post('/logout', [UserLoginController::class, 'logout']);
});

Route::get('/cures-info/{cursName}', [CursePageDataController::class, 'show']);

Route::post('/feedback', [FeedbackController::class, 'send']);

Route::post('/feedback', function (Request $request) {
	$data = $request->validate([
		'name' => 'required|string|max:100',
		'phone' => 'required|string|max:30',
		'email' => 'required|email|max:255',
	]);

	// Отправляем письмо пользователю
	Mail::to($data['email'])->send(new FeedbackUserMail($data));

	return response()->json(['message' => 'Письмо успешно отправлено!']);
});


