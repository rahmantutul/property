<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { 
        return [
            'propertyId' => $this->faker->randomElement(Property::pluck('id')->toArray()),
            'numOfBedroom' => $this->faker->numberBetween(4,9),
            'numOfBathroom' => $this->faker->numberBetween(2,4),
            'totalUnit' => $this->faker->numberBetween(2,4),
            'squareFeet' => $this->faker->numberBetween(2500, 4000),
            'lotSize' => $this->faker->numberBetween(25, 400),
            'lotAcre' => $this->faker->randomElement([1,9]),
            'lotType' => $this->faker->realText(200),
            'heat' => 'yes',
            'heat' => 'yes',
            'cooling' => 'yes',
            'fuel' => 'yes',
            'status' =>  1,
        ];
    }
}
