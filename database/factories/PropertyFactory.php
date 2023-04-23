<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Buyer;
use App\Models\GarageType;
use App\Models\PropertyType;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(15);
        $slug = Str::slug($title);
        return [
            'agentId' =>$this->faker->randomElement(Agent::pluck('id')->toArray()),
            'buyerId' =>$this->faker->randomElement(Buyer::pluck('id')->toArray()),
            'sellerId' =>$this->faker->randomElement(Seller::pluck('id')->toArray()),
            'typeId' =>$this->faker->randomElement(PropertyType::pluck('id')->toArray()),
            'garageTypeId' =>$this->faker->randomElement(GarageType::pluck('id')->toArray()),
            'mlsId' => $this->faker->numberBetween(1,100),
            'user_id' => $this->faker->numberBetween(1,10),
            'availableDate' => $this->faker->date(),
            'expireDate' => $this->faker->date(),
            'price' => $this->faker->numberBetween(11000,100000),
            'originalPrice' => $this->faker->numberBetween(11000,100000),
            'title' => $title,
            'thumbnail' => 'https://loremflickr.com/240/240/home?random='.$this->faker->numberBetween(1,600),
            'videoUrl'=>'https://www.youtube.com/watch?v=mUd7ddb-Quk',
            'virtualTour'=>$this->faker->realText(200),
            'previewText'=>$this->faker->realText(200),
            'isHideAddress' => $this->faker->randomElement([1,0]),
            'callForPrice' => $this->faker->randomElement([1,0]),
            'slug' => $slug,
            'status'=>1,

        ];
    }
}
