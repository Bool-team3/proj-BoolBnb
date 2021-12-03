<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['wifi','vista mare','piscina', 'posto macchina','portineria', 'sauna'];

        foreach ($services as $service) {

            $newService = new Service();

            $newService->name = $service;
            $newService->save();
        }
    }
}
