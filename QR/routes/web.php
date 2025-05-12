<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;
use App\Models\Activities;

Route::resource('/scan', ScanController::class);

Route::get('/', function () {
    return view('scan');
});

Route::post('/', [ScanController::class, 'store'])->name('generate.qr');