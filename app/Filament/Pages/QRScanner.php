<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Request;
use App\Models\Organizer;
use App\Models\Attendance;

class QRScanner extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static string $view = 'filament.pages.qr-scanner';

    public function scanQrCode(Request $request)
    {
        $organizer = Organizer::where('qr_code', $request->qr_code)->first();

        if ($organizer) {
            $attendance = Attendance::firstOrNew(
                ['organizer_id' => $organizer->id, 'checked_out_at' => null],
                ['checked_in_at' => now()]
            );

            if ($attendance->exists && $attendance->checked_in_at && !$attendance->checked_out_at) {
                $attendance->checked_out_at = now();
            }

            $attendance->save();

            return response()->json([
                'valid' => true,
                'organizer_name' => $organizer->name,
                'checked_in_at' => $attendance->checked_in_at,
                'checked_out_at' => $attendance->checked_out_at,
            ]);
        }

        return response()->json(['valid' => false]);
    }
}
