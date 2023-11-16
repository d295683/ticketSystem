<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus()
{
    $today = date('Y-m-d');
    $eventDate = $this->event->datetime->format('Y-m-d');

    if ($eventDate < $today) {
        if ($this->tickets->every->scanned) {
            return 'Historisch';
        } else {
            return 'Verlopen';
        }
    } else {
        return 'Toekomstig';
    }
}
}
