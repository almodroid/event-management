<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizer;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function scanQrCode(Request $request)
    {
        $organizer = Organizer::where('qr_code', $request->qr_code)->first();

        if ($organizer) {
            // سجل الحضور
            Attendance::create([
                'organizer_id' => $organizer->id,
                'event_id' => $organizer->current_event_id,
                'checked_in_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Organizer checked in successfully.');
        }

        return redirect()->back()->with('error', 'Invalid QR Code.');
    }
}
