<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentAreaController;

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

//prefix: auth, pertama2 prefix v1

Route::prefix('v1')->group(function () {
    //prefix auth, middleware auth:api
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('me', [AuthController::class, 'me']);
        //create user
        Route::post('create_user', [AuthController::class, 'create_user']);
        //register
        Route::post('register', [AuthController::class, 'register']);
    });

    //prefix user, middleware auth:api
    Route::prefix('user')->group(function () {
        Route::get('/dosen', [AuthController::class, 'index_dosen']);
        Route::get('/{id}', [AuthController::class, 'show_user']);
        Route::put('/{id}', [AuthController::class, 'update_user']);
        Route::delete('/{id}', [AuthController::class, 'destroy_user']);

    });

    //prefix study_program, middleware auth:api
    Route::prefix('study_program')->group(function () {
        Route::get('/', [StudyProgramController::class, 'index']);
        Route::get('/{id}', [StudyProgramController::class, 'show']);
        Route::post('/', [StudyProgramController::class, 'store']);
        Route::put('/{id}', [StudyProgramController::class, 'update']);
        Route::delete('/{id}', [StudyProgramController::class, 'destroy']);
    });

    //prefix faculty, middleware auth:api
    Route::prefix('faculty')->group(function () {
        Route::get('/', [FacultyController::class, 'index']);
        Route::get('/{id}', [FacultyController::class, 'show']);
        Route::post('/', [FacultyController::class, 'store']);
        Route::put('/{id}', [FacultyController::class, 'update']);
        Route::delete('/{id}', [FacultyController::class, 'destroy']);
    });

    //prefix course, middleware auth:api
    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/{id}', [CourseController::class, 'show']);
        Route::post('/', [CourseController::class, 'store']);
        Route::put('/{id}', [CourseController::class, 'update']);
        Route::delete('/{id}', [CourseController::class, 'destroy']);
    });

    //prefix user, middleware auth:api
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index_all_users']);
        Route::get('/{id}', [UserController::class, 'show_one_user']);
        Route::post('/', [UserController::class, 'store']);
        Route::post('update/{id}', [UserController::class, 'update_user']);
        Route::delete('/{id}', [UserController::class, 'destroy_user']);
    });

    //prefix class_room, middleware auth:api
    Route::prefix('class_room')->group(function () {
        Route::get('/', [ClassRoomController::class, 'index']);
        Route::get('/{id}', [ClassRoomController::class, 'show']);
        Route::post('/', [ClassRoomController::class, 'store']);
        Route::put('/{id}', [ClassRoomController::class, 'update']);
        Route::delete('/{id}', [ClassRoomController::class, 'destroy']);
    });

    //prefix schedule, middleware auth:api
    Route::prefix('schedule')->group(function () {
        Route::get('/', [ScheduleController::class, 'index']);
        Route::get('/{id}', [ScheduleController::class, 'show']);
        Route::post('/', [ScheduleController::class, 'store']);
        Route::put('/{id}', [ScheduleController::class, 'update']);
        Route::delete('/{id}', [ScheduleController::class, 'destroy']);
    });
    //tagihan
    Route::prefix('payment')->group(function () {
        //prefix semester_payment
        Route::prefix('semester_payment')->group(function () {
            Route::get('/', [TagihanController::class, 'index']);
            Route::get('/{id}', [TagihanController::class, 'show']);
            Route::post('/', [TagihanController::class, 'store_semester_payment']);
            Route::put('/{id}', [TagihanController::class, 'update']);
            Route::delete('/{id}', [TagihanController::class, 'destroy_semester_payment']);
        });
    });

    //prefix semester, middleware auth:api
    Route::prefix('semester')->group(function () {
        Route::get('/', [SemesterController::class, 'index']);
        Route::get('/{id}', [SemesterController::class, 'show']);
        Route::post('/', [SemesterController::class, 'store']);
        Route::put('/{id}', [SemesterController::class, 'update']);
        Route::delete('/{id}', [SemesterController::class, 'destroy']);
    });

    //prefix student_api
    Route::prefix('student_api')->group(function () {
        //prefix profile
        Route::prefix('profile')->group(function () {
            Route::get('/', [StudentAreaController::class, 'show_profile']);
            //save_profile
            Route::post('/save_profile', [StudentAreaController::class, 'save_profile']);
        });
    });



});
