<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HelpDeskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'userId'=>$this->faker->numberBetween(1,50),
            'userType' => $this->faker->numberBetween(2,4),
            'email' => $this->faker->safeEmail,
            'subject' =>  $this->faker->word(100),
            'status' => 1, //$this->faker->numberBetween(0,2),
            'created_at' =>  $this->faker->dateTimeBetween('-15 days','now'),
            'updated_at' =>  $this->faker->dateTimeBetween('-13 days','now'),
        ];
    }
}
