<?php

use App\Http\Controllers\FareController;
use App\Http\Controllers\OperatorController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(FareController::class)->prefix('fare')->group(function () {
    Route::get('/', 'index');
    Route::get('/{fareId}', 'show');
    Route::post('/', 'create');
});

Route::controller(OperatorController::class)->prefix('operator')->group(function () {
    Route::post('/', 'create');
});
