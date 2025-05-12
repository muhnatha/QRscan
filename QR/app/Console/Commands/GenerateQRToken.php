<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Activities;

class GenerateQRToken extends Command
{
    protected $signature = 'qr:generate';
    protected $description = 'Generate a fresh QR attendance token';

    public function handle()
    {
        // 1) Purge tokens older than 5 minutes
        Activities::where('created_at', '<', now()->subMinutes(5))->delete();

        // 2) Create a new activity row, with a UUID primary key and random qrCode
        Activities::create([
            'id'           => (string) Str::uuid(),             // ← supply the id!
            'activityName' => 'Attendance @ '.now()->format('H:i'),
            'qrCode'       => Str::random(32),
            'createdBy'    => auth()->id() ?? 'system',
        ]);

        $this->info('✅ New QR token generated.');
    }
}
