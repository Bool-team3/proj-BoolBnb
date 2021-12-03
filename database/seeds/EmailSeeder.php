<?php

use Faker\Generator as Faker;

use App\Models\Apartment;
use App\Models\Email;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartment_ids  = Apartment::pluck('id')->toArray();

        for($i = 0; $i < 10 ; $i++){
            
            $newEmail = new Email();
            $newEmail->apartment_id = Arr::random($apartment_ids);

            $newEmail->name = $faker->firstName();
            $newEmail->email_address = $faker->email();
            $newEmail->subject = $faker->word(6);
            $newEmail->message = $faker->paragraph(10);

            $newEmail->save();
        }
    }
}
