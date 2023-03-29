<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(2),
            'videoUrl' => "default.mp4",
            'referUrl' => 'https://www.youtube.com/watch?v=yFylquu64B8',
            'status' =>  1,
        ];
    }
}
