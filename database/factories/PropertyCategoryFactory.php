<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'propertyId' => $this->faker->randomElement(Property::pluck('id')),
            'categoryId' => $this->faker->randomElement(Category::pluck('id')),
            'status' =>  1,
        ];
    }
}
