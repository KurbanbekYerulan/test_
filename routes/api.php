<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MovementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/movements', [MovementController::class, 'index']);
    Route::post('/movements', [MovementController::class, 'store']);
    Route::get('/movements/export/excel', [MovementController::class, 'exportToExcel']);
    Route::get('/movements/export/xml', [MovementController::class, 'exportToXml']);
});
