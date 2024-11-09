<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudyProgramController;

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
        //register
        Route::post('register', [AuthController::class, 'register']);
    });

    //prefix study_program, middleware auth:api
    Route::prefix('study_program')->group(function () {
        Route::get('/', [StudyProgramController::class, 'index']);
        Route::get('/{id}', [StudyProgramController::class, 'show']);
        Route::post('/', [StudyProgramController::class, 'store']);
        Route::put('/{id}', [StudyProgramController::class, 'update']);
        Route::delete('/{id}', [StudyProgramController::class, 'destroy']);
    });

});
