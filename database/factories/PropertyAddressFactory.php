<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyAddressFactory extends Factory
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
            'cityId' => $this->faker->numberBetween(1,30),
            'stateId' => $this->faker->numberBetween(1,30),
            'countryId' => $this->faker->numberBetween(1,30),
            'streetNumber' => $this->faker->realText(200),
            'streetAddressOne' => $this->faker->realText(200),
            'streetAddressTwo' => $this->faker->realText(200),
            'shuitAppertment' => $this->faker->realText(200),
            'subDivision' => $this->faker->realText(200),
            'status' =>  1,
        ];
    }
}
