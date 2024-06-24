<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\FilamentUser;
 

class Organizer extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles, HasPanelShield;

    protected $fillable = ['name', 'email', 'password', 'qr_code'];
    
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($organizer) {
            if (!$organizer->qr_code) {
                $organizer->qr_code = base64_encode(QrCode::format('png')->size(200)->generate(Str::random(10)));
            }
        });
    }

    public function eventOrganizerGates()
    {
        return $this->hasMany(EventOrganizerGate::class);
    }

    protected $casts = [
        'qr_code' => 'string',
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_organizer_gates');
    }
    
    //public function event()
    //{
      //  return $this->belongsTo(Event::class);
    //}

    public function getTotalTicketsAttribute()
    {
        return $this->tickets()->count();
    }

    public function getScannedTicketsCountAttribute()
    {
        return $this->tickets()->where('is_scanned', true)->count();
    }
}
