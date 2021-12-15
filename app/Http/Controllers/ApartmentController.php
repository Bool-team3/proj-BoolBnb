<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function show($id)
    {
        $apartment = Apartment::find($id);
        return view('singleApartment', compact('apartment'));
    }
}
