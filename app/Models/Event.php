<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'image', 'available_tickets', 'max_ticket_quantity_per_customer', 'min_ticket_quantity_per_customer', 'tags'];

    public function gates()
    {
        return $this->hasMany(Gate::class);
    }

    public function eventOrganizerGates()
    {
        return $this->hasMany(EventOrganizerGate::class);
    }

    public function totalTicketsSold()
    {
        $onlineSales = $this->tickets()->count();
        $offlineSales = $this->offlineTicketSales()->sum('quantity_sold');

        return $onlineSales + $offlineSales;
    }
    
    //public function organizer()
    //{
      //  return $this->belongsTo(Organizer::class);
    //}

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'event_organizer_gates');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function offlineTicketSales()
    {
        return $this->hasMany(OfflineTicketSale::class);
    }

    protected $casts = [
        'tags' => 'array',
    ];
}
