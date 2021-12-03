<?php

use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();
       
        $sponsor_ids =  Sponsor::pluck('id', "time")->toArray();
        $sponsor_time = Sponsor::pluck("time")->toArray();
        
    
        for($i=0 ; $i < 6; $i++){
            $apartments[$i]->sponsors()->sync([Arr::random($sponsor_ids) => 
            ["expiration_date" => Carbon::now()->addDays(Arr::random($sponsor_time))]]);
        }
     
    }
}
