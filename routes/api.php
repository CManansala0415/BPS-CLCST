<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/get-degree/{type}', [MainController::class,'getDegree']);
Route::middleware(['auth:sanctum'])->get('/get-program', [MainController::class,'getProgram']);
Route::middleware(['auth:sanctum'])->get('/get-quarter', [MainController::class,'getQuarter']);
Route::middleware(['auth:sanctum'])->get('/get-semester', [MainController::class,'getSemester']);
Route::middleware(['auth:sanctum'])->get('/get-program-list', [MainController::class,'getProgramList']);

Route::middleware(['auth:sanctum'])->post('/save-course-college', [MainController::class,'saveCourseCollege']);

