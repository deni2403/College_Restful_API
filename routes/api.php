<?php

use App\Http\Controllers\LecturersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudentsSubjectsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users
Route::post('/users', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::get('/users/current', [UserController::class, 'get']);
    Route::patch('/users/current', [UserController::class, 'update']);
    Route::delete('/users/logout', [UserController::class, 'logout']);
    
    // Students
    Route::post('/students', [StudentsController::class, 'store']);
    Route::get('/students', [StudentsController::class, 'index']);
    Route::get('/students/{id}', [StudentsController::class, 'show']);
    Route::put('/students/{id}', [StudentsController::class, 'update']);
    Route::delete('/students/{id}', [StudentsController::class, 'destroy']);
    
    // Lecturers
    Route::post('/lecturers', [LecturersController::class, 'store']);
    Route::get('/lecturers', [LecturersController::class, 'index']);
    Route::get('/lecturers/{id}', [LecturersController::class, 'show']);
    Route::put('/lecturers/{id}', [LecturersController::class, 'update']);
    Route::delete('/lecturers/{id}', [LecturersController::class, 'destroy']);
    
    // Subjects
    Route::post('/subjects', [SubjectsController::class, 'store']);
    Route::get('/subjects', [SubjectsController::class, 'index']);
    Route::get('/subjects/{id}', [SubjectsController::class, 'show']);
    Route::put('/subjects/{id}', [SubjectsController::class, 'update']);
    Route::delete('/subjects/{id}', [SubjectsController::class, 'destroy']);
    
    // Students Subjects
    Route::post('/students_subjects', [StudentsSubjectsController::class, 'store']);
    Route::get('/students_subjects', [StudentsSubjectsController::class, 'index']);
    Route::get('/students_subjects/{id}', [StudentsSubjectsController::class, 'show']);
    Route::put('/students_subjects/{id}', [StudentsSubjectsController::class, 'update']);
    Route::delete('/students_subjects/{id}', [StudentsSubjectsController::class, 'destroy']);
});




