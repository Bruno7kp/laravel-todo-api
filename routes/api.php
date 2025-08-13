<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\QuoteController;

Route::apiResource('tasks', TaskController::class);
Route::get('quotes/random', [QuoteController::class, 'random']);
