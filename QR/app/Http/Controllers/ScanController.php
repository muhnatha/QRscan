<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Activities;

class ScanController extends Controller
{
    public function index() {
        $latest = Activities::latest()->first();
        return view('scan', ['qr' => $latest->qrCode ?? 'no-code']);
    }
}
