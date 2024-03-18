<?php

use App\Http\Controllers\HunterController;
use App\Http\Controllers\TalentController;
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

// Route::apiResource('/hunter', HunterController::class);
// Route::post('/hunter/register', [HunterController::class, 'register']);
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', [HunterController::class, 'login']);
    Route::post('register', [HunterController::class, 'register']);
    Route::post('logout', [HunterController::class, 'logout']);
    Route::post('refresh', [HunterController::class, 'refresh']);
    Route::post('me', [HunterController::class, 'me']);
});

Route::get('/talent/{reveral_hunter}', [TalentController::class, 'show']);
Route::post('/talent/register', [TalentController::class, 'store']);
// Route::post('/register', [HunterController::class, 'register']);

// Route::middleware('jwt.auth')->get('/user/{user}', [HunterController::class, 'show']);