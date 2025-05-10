<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;

# Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');

Route::get('/', function () {
    return view('scan');
});
