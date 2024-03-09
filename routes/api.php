<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\AddressController;
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
// Route::middleware(['auth:sanctum'])->post('/save-program', [ProgramController::class,'saveProgram']);

Route::middleware(['auth:sanctum'])->get('/get-subject', [RegistrarController::class,'getSubject']);
Route::middleware(['auth:sanctum'])->get('/get-section', [RegistrarController::class,'getSection']);
Route::middleware(['auth:sanctum'])->get('/get-gradelvl', [RegistrarController::class,'getGradelvl']);
Route::middleware(['auth:sanctum'])->get('/get-classroom', [RegistrarController::class,'getClassroom']);
Route::middleware(['auth:sanctum'])->get('/get-roomtype', [RegistrarController::class,'getRoomType']);
Route::middleware(['auth:sanctum'])->get('/get-buildingtype', [RegistrarController::class,'getBuildingType']);
Route::middleware(['auth:sanctum'])->get('/get-department', [RegistrarController::class,'getDepartment']);
Route::middleware(['auth:sanctum'])->get('/get-degree', [RegistrarController::class,'getDegree']);
Route::middleware(['auth:sanctum'])->get('/get-program-list', [RegistrarController::class,'getProgramList']);
Route::middleware(['auth:sanctum'])->get('/get-curriculum', [RegistrarController::class,'getCurriculum']);

Route::middleware(['auth:sanctum'])->post('/save-section', [RegistrarController::class,'saveSection']);
Route::middleware(['auth:sanctum'])->post('/save-gradelvl', [RegistrarController::class,'saveGradelvl']);
Route::middleware(['auth:sanctum'])->post('/save-classroom', [RegistrarController::class,'saveClassroom']);
Route::middleware(['auth:sanctum'])->post('/save-subject', [RegistrarController::class,'saveSubject']);
Route::middleware(['auth:sanctum'])->post('/save-department', [RegistrarController::class,'saveDepartment']);
Route::middleware(['auth:sanctum'])->post('/save-program', [RegistrarController::class,'saveProgram']);
Route::middleware(['auth:sanctum'])->post('/add-program', [RegistrarController::class,'addProgram']);
Route::middleware(['auth:sanctum'])->post('/add-section', [RegistrarController::class,'addSection']);
Route::middleware(['auth:sanctum'])->post('/add-gradelvl', [RegistrarController::class,'addGradelvl']);
Route::middleware(['auth:sanctum'])->post('/add-subject', [RegistrarController::class,'addSubject']);
Route::middleware(['auth:sanctum'])->post('/add-department', [RegistrarController::class,'addDepartment']);
Route::middleware(['auth:sanctum'])->post('/add-classroom', [RegistrarController::class,'addClassroom']);
Route::middleware(['auth:sanctum'])->post('/add-curriculum', [RegistrarController::class,'addCurriculum']);
Route::middleware(['auth:sanctum'])->get('/get-applicant', [RegistrarController::class,'getApplicant']);
Route::middleware(['auth:sanctum'])->get('/get-gender', [RegistrarController::class,'getGender']);
Route::middleware(['auth:sanctum'])->get('/get-nationality', [RegistrarController::class,'getNationality']);
Route::middleware(['auth:sanctum'])->get('/get-civilstatus', [RegistrarController::class,'getCivilStatus']);


Route::middleware(['auth:sanctum'])->get('/get-region', [AddressController::class,'getRegion']);
Route::middleware(['auth:sanctum'])->get('/get-province', [AddressController::class,'getProvince']);
Route::middleware(['auth:sanctum'])->get('/get-city', [AddressController::class,'getCity']);
Route::middleware(['auth:sanctum'])->get('/get-barangay', [AddressController::class,'getBarangay']);

Route::middleware(['auth:sanctum'])->post('/add-applicant/{type}', [RegistrarController::class,'addApplicant']);
Route::middleware(['auth:sanctum'])->get('/get-family/{personid}', [RegistrarController::class,'getFamily']);
Route::middleware(['auth:sanctum'])->get('/get-award/{personid}', [RegistrarController::class,'getAward']);
Route::middleware(['auth:sanctum'])->get('/get-attainment/{personid}', [RegistrarController::class,'getAttainment']);






