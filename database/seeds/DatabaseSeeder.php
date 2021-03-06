<?php

use App\Models\Visitor;
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
        $this->call([
            UserSeeder::class,
            ApartmentSeeder::class,
            ServiceSeeder::class,
            ApartmentServiceSeeder::class,
            SponsorSeeder::class,
            ApartmentSponsorSeeder::class,
            EmailSeeder::class,
            VisitorSeeder::class,
        ]);
    }
}
