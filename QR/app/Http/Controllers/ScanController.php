<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Models\Activities;

class ScanController extends Controller
{
    public function index() {
        $activity = Activities::latest()->first();
        return view('scan', compact('activity'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'activity' => 'required|string'
        ]);

        $qrCode = QrCode::format('png')->size(200)->generate($request->input('activity'));

        $fileName = 'qr_' . time() . '.png';
        $filePath = public_path('qrcodes/' . $fileName);

        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0775, true);
        }

        file_put_contents($filePath, $qrCode);

        // Pass the file name to the view so it can be displayed
        return back()->with('qrFileName', $fileName)->with('success', 'QR Code generated and saved successfully!');
    }
}