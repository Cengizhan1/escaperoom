<?php

namespace Database\Factories;

use App\Models\EscapeRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EscapeRoom>
 */
class TimeSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'escape_room_id' => function () {
                return EscapeRoom::inRandomOrder()->first()->id;
            },
            'start_time' => '10:10',
            'end_time' => '11:10',
            'max_participants' => $this->faker->numberBetween(1, 10),
        ];
    }
}
