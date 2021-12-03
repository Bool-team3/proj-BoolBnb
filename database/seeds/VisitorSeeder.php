<?php

use Illuminate\Support\Carbon;
use App\Models\Apartment;
use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       
        $apartment_ids  = Apartment::pluck('id')->toArray();
        
        for($i=0 ; $i < count($apartment_ids) ; $i++){
            
            $newVisitor = new Visitor();
            $newVisitor->apartment_id = Arr::random($apartment_ids);

            $newVisitor->date = Carbon::now();
            $newVisitor->ip = $faker->ipv4();

            $newVisitor->save();
        }
    }
}
