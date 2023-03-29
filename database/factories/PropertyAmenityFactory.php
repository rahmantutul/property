<?php

namespace Database\Factories;

use App\Models\AmenityType;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyAmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'propertyId'=>$this->faker->randomElement(Property::pluck('id')),
            'amenityId'=>$this->faker->randomElement(AmenityType::pluck('id')),
        ];
    }
}
