<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'escape_room_id',
        'start_time',
        'end_time',
        'max_participants',
    ];

    public function escapeRoom()
    {
        return $this->belongsTo(EscapeRoom::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
