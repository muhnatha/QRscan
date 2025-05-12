<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Activities;

class ScanController extends Controller
{
    public function latestQr(){
    $qr = Activities::latest()->first();
    return response()->json([
        'qr' => $qr->qrCode ?? 'no-code'
    ]);
    }
}
