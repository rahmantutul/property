<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayValues = ['Image','Video'];
        return [
            'propertyId'=>$this->faker->randomElement(Property::pluck('id')),
            'imageUrl'=> 'https://loremflickr.com/240/240/home?random='.$this->faker->numberBetween(1,600),
            'type'=>$arrayValues[rand(0,1)],
        ];
    }
}
