<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineTicketSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'date',
        'quantity_sold',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
