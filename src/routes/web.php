<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleSheetController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AquariumController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GoogleSheetsTestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/google-sheet', [GoogleSheetController::class, 'index'])->name('google.sheet');

// GoogleSheetsAPI接続確認ルート
Route::get('/test-google-sheets', [GoogleSheetController::class, 'appendData'])->name('test.google.sheets');
