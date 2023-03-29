<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AmenityTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayValues = ['General Amenities','Interior Amenities','Exterior Amenities'];
        return [
            'amenity'=>$this->faker->realText(20),
            'amenityType'=>$arrayValues[rand(0,2)],
            'status'=>1,
        ];
    }
}
