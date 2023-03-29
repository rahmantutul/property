<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use App\Models\HelpDesk;
use Illuminate\Database\Eloquent\Factories\Factory;

class HelpDeskDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'helpDeskId'=>$this->faker->randomElement(HelpDesk::pluck('id')),
            'userId'=>$this->faker->randomElement(Admin::pluck('id')),
            'userType' => $this->faker->numberBetween(1,5),
            // 'email' => $this->faker->safeEmail,
            // 'subject' =>  $this->faker->word(10),
            'message' =>  $this->faker->word(2000),
            'status' => 1, //$this->faker->numberBetween(1),
            'created_at' =>  $this->faker->dateTimeBetween('-15 days','now'),
            'updated_at' =>  $this->faker->dateTimeBetween('-15 days','now'),
        ];
    }
}
