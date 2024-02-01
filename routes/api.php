<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SubjectController;
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

Route::middleware(['auth:sanctum'])->get('/get-degree/{type}', [ProgramController::class,'getDegree']);
Route::middleware(['auth:sanctum'])->get('/get-program', [ProgramController::class,'getProgram']);
Route::middleware(['auth:sanctum'])->get('/get-quarter', [ProgramController::class,'getQuarter']);
Route::middleware(['auth:sanctum'])->get('/get-semester', [ProgramController::class,'getSemester']);
Route::middleware(['auth:sanctum'])->get('/get-program-list/{id}', [ProgramController::class,'getProgramList']);
Route::middleware(['auth:sanctum'])->post('/save-program', [ProgramController::class,'saveProgram']);

Route::middleware(['auth:sanctum'])->get('/get-subject', [SubjectController::class,'getSubject']);





