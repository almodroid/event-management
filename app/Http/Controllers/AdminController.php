<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function markAttendance(Request $request)
    {
        // تحقق من QR code واتخاذ الإجراءات اللازمة
        // مثال:
        $qrCode = $request->input('qr_code');
        $attendance = Attendance::where('qr_code', $qrCode)->first();
        if ($attendance) {
        $attendance->is_present = true;
        $attendance->save();
        return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

        // في الوقت الحالي، مجرد محاكاة النجاح
        return response()->json(['success' => true]);
    }
    
    public function analytics()
    {
        $totalOrganizers = Organizer::count();
        $totalEvents = Event::count();
        $totalTicketsSold = Ticket::count();
        $totalScannedTickets = Ticket::whereNotNull('scanned_by')->count();
        $organizers = Organizer::with('scannedTickets')->get();

        return view('admin.analytics', compact('totalOrganizers', 'totalEvents', 'totalTicketsSold', 'totalScannedTickets', 'organizers'));
    }
}
