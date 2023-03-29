<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         return [
            'name' => $this->faker->randomElement(['Admin','HR','Manager']),
            'guard_name' =>'admin',
            'status' => 1,
        ];
    }
}
