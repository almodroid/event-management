<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'customer_email', 'event_id', 'qr_code', 'is_scanned', 'date', 'scanned_by'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            $ticket->qr_code = base64_encode(QrCode::format('png')->size(200)->generate(Str::random(10)));
        });
    }

    protected $casts = [
        'is_scanned' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'scanned_by');
    }

    public function generateQrCode()
    {
        $url = route('ticket.show', $this->id);
        $qrcode = \QrCode::format('png')->size(200)->generate($url);
        $this->qr_code = base64_encode($qrcode);
        $this->save();
    }

    public function expire()
    {
        $this->is_scanned = false;
        $this->save();
    }
}