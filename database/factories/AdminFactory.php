<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => 'admin@gmail.com',//$this->faker->unique()->safeEmail,
            'phone' =>  $this->faker->phoneNumber,
            'address' =>  $this->faker->address,
            'password' => Hash::make('Abc123@'), // password
            'avatar' => 'https://loremflickr.com/240/240/user?random='.$this->faker->numberBetween(1,600),
            'roleId' => $this->faker->randomElement(Role::pluck('id')),
            'roleId' => 1,
            'status' => 1,
        ];
    }
}
