<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketPurchased;


class TicketController extends Controller
{
    public function verify(Request $request)
    {
        $ticket = Ticket::where('qr_code', $request->qr_code)->first();

        if ($ticket && !$ticket->is_scanned) {
            // قم بتحديث حالة التذكرة إلى "تم المسح"
            $ticket->is_scanned = true;
            $ticket->save();

            return response()->json([
                'valid' => true,
                'attendee_name' => $ticket->attendee->name
            ]);
        }

        return response()->json(['valid' => false]);
    }
    
    public function buy(Event $event)
    {
        return view('tickets.buy', compact('event'));
    }

    public function process(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min=1',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // معالجة الدفع باستخدام بوابة PayLink
        $paymentResponse = $this->processPayment($request->all(), $event);

        if ($paymentResponse['status'] == 'success') {
            // إنشاء التذاكر
            for ($i = 0; $i < $request->quantity; $i++) {
                $ticket = Ticket::create([
                    'customer_name' => $request->name,
                    'customer_email' => $request->email,
                    'event_id' => $event->id,
                    'date' => $request->date,
                    'is_scanned' => false,
                ]);

                // إرسال البريد الإلكتروني مع التذكرة
                Mail::to($request->email)->send(new TicketPurchased($ticket));
            }

            return redirect()->route('tickets.thankyou')->with('success', __('Payment successful and ticket(s) sent to your email.'));
        }

        return redirect()->back()->with('error', __('Payment failed. Please try again.'));
    }

    private function processPayment($data, $event)
    {
        // منطق معالجة الدفع باستخدام PayLink
        return [
            'status' => 'success', // أو 'failed'
        ];
    }
}
