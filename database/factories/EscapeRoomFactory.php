<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EscapeRoom>
 */
class EscapeRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'theme' => $this->faker->sentence(3),
            'maximum_participants' => $this->faker->numberBetween(1, 10)
        ];
    }
}
