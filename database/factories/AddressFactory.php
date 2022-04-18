<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'street' => $this->faker->streetAddress(),
            'city'   => $this->faker->city(),
            'state'  => $this->faker->stateAbbr(),
            'zip'    => $this->faker->postcode(),
        ];
    }
}
