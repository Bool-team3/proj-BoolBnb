<?php

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors_name = ['bronze','silver','gold'];
        $sponsors_time = [1, 2 , 3];
        
        $sponsors_price = [2.99, 5.99, 9.99 ];
        
        for( $i=1 ; $i <= 3 ; $i++ ){
            $newSponsor = new Sponsor();

            $newSponsor->name = $sponsors_name[ $i - 1 ];
            $newSponsor->rank = $i;
            $newSponsor->time = $sponsors_time[$i - 1];
            $newSponsor->price = $sponsors_price[$i - 1];
            $newSponsor->save();
        }
        

    }
}
