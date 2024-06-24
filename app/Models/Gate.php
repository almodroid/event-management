<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // إذا كانت العلاقة مع المنظمين ضرورية لربط المنظمين بالبوابات في الفعاليات، يمكن الاحتفاظ بها
    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'event_organizer_gates')
                    ->withPivot('event_id')
                    ->withTimestamps();
    }
}
