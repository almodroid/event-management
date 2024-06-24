<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Event;
use App\Models\Organizer;

class OrganizerController extends Controller
{
    public function dashboard()
    {
        $organizer = Auth::guard('organizer')->user();
        $scannedTickets = Ticket::where('scanned_by', $organizer->id)->get();
        $scannedTicketsCount = $scannedTickets->count();
        $totalTicketsCount = Ticket::where('customer_email', $organizer->email)->count();

        // جلب الفعالية المرتبطة بالمنظم باستخدام جدول الربط
        $event = Event::whereHas('organizers', function ($query) use ($organizer) {
            $query->where('organizer_id', $organizer->id);
        })->first();

        return view('organizers.dashboard', compact('organizer', 'scannedTickets', 'scannedTicketsCount', 'totalTicketsCount', 'event'));
    }

    public function showScanner()
    {
        $organizer = Auth::guard('organizer')->user();
        return view('organizers.scanner', compact('organizer'));
    }

    public function scanTicket(Request $request)
    {
        $ticket = Ticket::where('qr_code', $request->qr_code)
                        ->where('date', $request->date) // تحقق من تاريخ التذكرة
                        ->first();

        if ($ticket && !$ticket->is_scanned) {
            $ticket->is_scanned = true;
            $ticket->scanned_by = Auth::guard('organizer')->id();
            $ticket->save();

            return response()->json([
                'valid' => true,
                'attendee_name' => $ticket->customer_name,
            ]);
        }

        return response()->json(['valid' => false]);
    }

    public function showTickets()
    {
        $events = Event::all();
        return view('organizers.tickets', compact('events'));
    }

    public function addTicket(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'event_id' => 'required|exists:events,id',
            'date' => 'required|date',
        ]);

        Ticket::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'event_id' => $request->event_id,
            'date' => $request->date,
            'is_scanned' => false,
        ]);

        return redirect()->route('organizer.tickets')->with('success', 'Ticket added successfully!');
    }
    
    
    
    
    //////
    
    
    public function getOrganizerByQrCode(Request $request)
    {
        $organizer = Organizer::where('qr_code', $request->qr_code)->first();

        if ($organizer) {
            return response()->json([
                'organizer_id' => $organizer->id,
                'organizer_name' => $organizer->name
            ]);
        }

        return response()->json(['organizer_id' => null]);
    }
    public function markAttendance(Request $request)
    {
        $organizer = Organizer::where('qr_code', $request->qr_code)->first();

        if ($organizer) {
            $attendance = Attendance::firstOrCreate(
                [
                    'organizer_id' => $organizer->id,
                    'event_id' => $request->event_id,
                    'date' => now()->toDateString(),
                ],
                [
                    'is_present' => true,
                    'time_in' => now(),
                ]
            );

            if (!$attendance->wasRecentlyCreated) {
                $attendance->update(['time_out' => now()]);
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
