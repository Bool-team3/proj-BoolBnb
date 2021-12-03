<?php

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();
        $service_ids =  Service::pluck('id')->toArray();

        foreach($apartments as $apartment){
            $apartment->services()->sync([Arr::random($service_ids), Arr::random($service_ids), Arr::random($service_ids)]);
        }
    }
}
