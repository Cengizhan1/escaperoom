<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'escape_room_id',
        'time_slot_id',
        'discount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function escapeRoom()
    {
        return $this->belongsTo(EscapeRoom::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }
}
