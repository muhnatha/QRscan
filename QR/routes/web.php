<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\ScanController;
use App\Models\Activities;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// to start the user to "/"
Route::get('/', function () {
    $latest = Activities::latest()->first();
    $qr = $latest ? $latest->qrCode : 'NO_DATA';
    return view('scan', compact('qr'));
});

//  to get the latest QR
Route::get('/latest-qr', function () {
    $latest = Activities::latest()->first();
    return response()->json(['qr' => $latest?->qrCode ?? 'NO_QR_FOUND']);
});

// make QR out of string
Route::get('/generate-qr-svg/{token}', function ($token) {
    return QrCode::size(250)->generate($token);
});

// onclick generate QR
Route::post('/generate-qr', function () {
    Activities::create([
        'id'           => (string) Str::uuid(),
        'activityName' => 'Attendance @ ' . now()->format('H:i:s'),
        'qrCode'       => Str::uuid()->toString(),
        'createdBy'    => auth()->id() ?? 'system',
    ]);

    return response()->json(['status' => 'ok']);
});