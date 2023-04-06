<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'websitename' => 'asd',
            'logo' => 'asd',
            'facebook' => 'asd',
            'linkedin' => 'asd',
            'twitter' => "asd",
            'copyright' => "asd",
            'disclaimer' => "asd",
            'location' => "asd",
            'email' => "asd",
            'phone' => "asd",
            'fax' => "asd",
        ];
    }
}
