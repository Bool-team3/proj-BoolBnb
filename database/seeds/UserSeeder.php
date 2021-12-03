<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {        
        for ($i = 0 ; $i < 10 ; $i++){
            $newUser = new User();
            

            $newUser->name = $faker->firstName();
            $newUser->surname = $faker->lastName();
            $newUser->email = $faker->safeEmail();
            $newUser->password = bcrypt($faker->password(9,14));
            $newUser->country = 'Italia';
            $newUser->telephone = $faker->phoneNumber();
            $newUser->save();
        }
    }
}
