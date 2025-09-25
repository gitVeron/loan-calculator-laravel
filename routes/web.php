<?php

use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::post('api/loan/schedule', [LoanController::class, 'schedule']);
Route::get('/calculator', function () {
    return view('calculator');
});
Route::get('/', function () {
    return view('welcome');
});