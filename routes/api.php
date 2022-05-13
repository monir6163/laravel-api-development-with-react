<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClassesController;

//class api route
Route::get('class', [ClassesController::class, 'index']);
Route::get('class/{id}', [ClassesController::class, 'show']);
Route::post('class', [ClassesController::class, 'store']);
Route::put('class/{id}', [ClassesController::class, 'update']);
Route::delete('class/{id}', [ClassesController::class, 'destroy']);
