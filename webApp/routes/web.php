<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes (learning CRUD)
|--------------------------------------------------------------------------
*/

Route::get('/', [InfoController::class, 'index'])->name('dashboard');

Route::resource('articles', ArticleController::class);


