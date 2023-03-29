<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NeighborFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail,
            'phone' =>  $this->faker->phoneNumber,
            'avatar' =>  $this->faker->imageUrl('app-assets/images/default.png'),
            'address'=>$this->faker->word(10),
            'status' =>  $this->faker->numberBetween(0,2),
        ];
    }
}
