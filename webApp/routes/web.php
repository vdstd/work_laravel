<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (clean skeleton)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $status = 'error';
    $error = null;
    $dbName = null;

    try {
        DB::connection()->getPdo();
        $status = 'connected';
        $dbName = DB::connection()->getDatabaseName();
    } catch (\Throwable $e) {
        $error = $e->getMessage();
    }

    return view('welcome', compact('status', 'error', 'dbName'));
});

