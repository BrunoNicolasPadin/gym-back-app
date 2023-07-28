<?php

use App\Http\Controllers\DayController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\LovController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require __DIR__.'/auth.php';
Route::apiResource('lovs', LovController::class);
Route::apiResource('exercises', ExerciseController::class);
Route::get('lovs-for-category', [LovController::class, 'getLovsForCategory']);
Route::apiResource('workouts', WorkoutController::class);
Route::prefix('workouts/{workout_id}')->group(function () {
    Route::apiResource('days', DayController::class);
});