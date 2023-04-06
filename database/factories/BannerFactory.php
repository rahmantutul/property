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
            'play_film_banner' => 'asd',
            'search_banner' => 'asd',
            'map_banner' => 'asd',
            'featured_banner' => 'asd',
            'neighbour_banner' => "asd",
            'status' =>  1,
        ];
    }
}
