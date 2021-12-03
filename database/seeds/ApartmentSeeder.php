<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\Models\Apartment;
use App\User;;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        
        $user_ids  = User::pluck('id')->toArray();

        for($i = 0; $i < 20; $i++)
        {
            $newApartment = new Apartment();

            $newApartment->user_id = Arr::random($user_ids);
            $newApartment->title = $faker->sentence(4);
            $newApartment->room = $faker->numberBetween(1, 5);
            $newApartment->bedroom = $faker->numberBetween(1, 2);
            $newApartment->bathroom = $faker->numberBetween(1, 2);
            $newApartment->bed = $faker->numberBetween(1, 2);
            $newApartment->mq = $faker->randomNumber(3, true);
            $newApartment->img_url = $faker->imageUrl(300, 300, 'team3', true);
            $newApartment->visible = $faker->boolean();
            $newApartment->street_name = $faker->streetName();
            $newApartment->street_number = $faker->buildingNumber();
            $newApartment->province = $faker->citySuffix();
            $newApartment->city = $faker->city();
            $newApartment->postal_code = $faker->randomNumber(5, true);
            $newApartment->lat = $faker->latitude();
            $newApartment->lon = $faker->longitude();

            $newApartment->save();
        }
    }
}
