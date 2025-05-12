<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;
use App\Models\Activities;

Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');

Route::get('/', function () {
    $latest = Activities::latest()->first();
    $qr = $latest ? $latest->qrCode : 'NO_DATA';
    return view('scan', compact('qr'));
});
