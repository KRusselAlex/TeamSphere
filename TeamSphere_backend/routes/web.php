<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('/verified-page', function () {
    return view('verified-page');
})->name('verified.page');

// require __DIR__.'/auth.php';
