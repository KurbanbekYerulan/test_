<?php

use App\Http\Controllers\Web\MovementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::get('/movements/{id}/document', [MovementController::class, 'showDocument'])->name('movements.document');
Route::post('/movements/{id}/document/edit', [MovementController::class, 'editDocument'])->name('movements.document.edit');
Route::get('/movements/report', [MovementController::class, 'report'])->name('movements.report');

