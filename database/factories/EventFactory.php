<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address'       => $this->faker->address(),
            'date_event'    => $this->faker->dateTime(),
            'title'         => $this->faker->sentence(5),
            'description'   => $this->faker->text(300),
            'lat'           => $this->faker->latitude,
            'lng'           => $this->faker->longitude,
        ];
    }
}
