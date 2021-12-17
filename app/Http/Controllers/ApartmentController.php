<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Apartment;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);

        // $serviceIds = Service::pluck('id')->toArray();
        // $services = Service::findOrFail($id)->id;

        // dd($services);
        
        return view('singleApartment', compact('apartment'));
    }
}
