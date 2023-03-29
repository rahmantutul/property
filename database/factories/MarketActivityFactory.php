<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarketActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reportName'=>$this->faker->realText(20),
            'reportSubject'=>$this->faker->realText(20),
            'reportDetails'=>$this->faker->realText(20),
            'shareStatus'=>1,
            'attachmentOne'=>'default.pdf',
            'attachmentTwo'=>'default.pdf',
            'attachmentThree'=>'default.pdf',
        ];
    }
}
