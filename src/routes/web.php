<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/google-sheet', [GoogleSheetController::class, 'index'])->name('google.sheet');
