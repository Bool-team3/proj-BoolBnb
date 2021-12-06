<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $apartments = Apartment::where("user_id", Auth::user()->id)->orderBy("created_at","desc")->paginate(10);
        $apartments = Apartment::all();
        return view('user.apartments.index', compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartment = new Apartment();
        
        return view('user.apartments.create', compact('apartment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([]);

        $data = $request->all();   
        $response = Http::get('https://api.tomtom.com/search/2/structuredGeocode.json', [

            'countryCode' => 'IT',
            'streetNumber' =>  $data['street_number'],           
            'streetName' =>  $data['street_name'],
            'municipality' => $data['city'],
            'municipalitySubdivision' => $data['province'],
            'postalCode' => $data['postal_code'],
            'key' => 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'
        ]);

        $lat = $response->json()['results'][0]['position']['lat'];
        $lon = $response->json()['results'][0]['position']['lon'];

        $apartment = new Apartment();

        $apartment->lat = $lat;
        $apartment->lon = $lon;

        $apartment->fill($data);
        $apartment->save();

        return redirect()->route('user.apartments.show', compact('apartment'));
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view("user.apartments.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
