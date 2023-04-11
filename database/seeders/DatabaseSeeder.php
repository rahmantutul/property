<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\AmenityType;
use App\Models\Banner;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\GarageType;
use App\Models\HelpDesk;
use App\Models\HelpDeskDetails;
use App\Models\MarketActivity;
use App\Models\Neighbor;
use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\PropertyDetails;
use App\Models\PropertyImages;
use App\Models\PropertyType;
use App\Models\Seller;
use App\Models\Role;
use App\Models\State;
use App\Models\PropertyCategory;
use App\Models\PropertyAddress;
use App\Models\WebsiteInfo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        Role::factory(1)->create();
        $this->call(AdminSeeder::class);
        AmenityType::factory(50)->create();
        Category::factory(50)->create();
        City::factory(50)->create();
        Country::factory(50)->create();
        GarageType::factory(50)->create();
        // MarketActivity::factory(50)->create();
        PropertyType::factory(50)->create();
        State::factory(50)->create();
        Property::factory(50)->create();
        PropertyAddress::factory(100)->create();

        PropertyAmenity::factory(200)->create();
        PropertyImages::factory(200)->create();
        PropertyDetails::factory(200)->create();
        PropertyCategory::factory(500)->create();
        HelpDesk::factory(1000)->create();
        HelpDeskDetails::factory(5000)->create();
        Neighbor::factory(50)->create();
        WebsiteInfo::factory(1)->create();
        Banner::factory(1)->create();
    }
}
