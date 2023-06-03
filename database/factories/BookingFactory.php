<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'escape_room_id' => EscapeRoom::factory()->create()->id,
            'time_slot_id' => TimeSlot::factory()->create()->id,
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
