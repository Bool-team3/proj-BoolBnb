<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
// use App\User;


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

        $services = Service::all();
        
        return view('user.apartments.create', compact('apartment', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'room' => 'numeric|required|between:1,20',
            'bedroom' => 'numeric|required|between:1,20',
            'bathroom' => 'numeric|required|between:1,20',
            'bed' => 'numeric|required|between:1,20',
            'mq' => 'numeric|required|between:10,700',
            //urL img - upload
            'city' => 'required|string|max:30',
            'street_name' => 'required|string|max:60',
            'street_number' => 'required|string|max:10',
            'province' => 'required|string|max:30',
            'postal_code' => 'required|string|between:5,5',

        ]);

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

        // dd($response->json()['summary']['numResults']);
        if($response->json()['summary']['numResults'] != 1){
            return redirect()->route('user.apartments.create')->with('error', $response->json()['results'][0]['position'])->with('error_message', 'L\'indirizzo inserito non è corretto.');
        }

        // dd($response->json()['summary']['numResults']);
        $lat = $response->json()['results'][0]['position']['lat'];
        $lon = $response->json()['results'][0]['position']['lon'];

        // $data['img_url'] = Storage::put('public', $data['img']);

        $apartment = new Apartment();

        $apartment->lat = $lat;
        $apartment->lon = $lon;

        $apartment->fill($data);
        $apartment->save();

        if(array_key_exists('services', $data)) $apartment->services()->sync($data['services']);

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
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $serviceIds = $apartment->services->pluck('id')->toArray();
        return view('user.apartments.edit', compact('apartment', 'services', 'serviceIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        
        
        $request->validate([
            'title' => 'required|string|max:120',
            'room' => 'numeric|required|between:1,20',
            'bedroom' => 'numeric|required|between:1,20',
            'bathroom' => 'numeric|required|between:1,20',
            'bed' => 'numeric|required|between:1,20',
            'mq' => 'numeric|required|between:10,700',
            //urL img - upload
            'city' => 'required|string|max:30',
            'street_name' => 'required|string|max:60',
            'street_number' => 'required|string|max:10',
            'province' => 'required|string|max:30',
            'postal_code' => 'required|string|between:5,5',

        ]);

        $data = $request->all();   

        //SU QUESTA COSA MI DA UN ERRORE: cURL error 60: SSL certificate problem: unable to get local issuer certificate
        //CREDO ABBIA A CHE FARE CON LA CHIAMATA API

        // $response = Http::get('https://api.tomtom.com/search/2/structuredGeocode.json', [

        //     'countryCode' => 'IT',
        //     'streetNumber' =>  $data['street_number'],           
        //     'streetName' =>  $data['street_name'],
        //     'municipality' => $data['city'],
        //     'municipalitySubdivision' => $data['province'],
        //     'postalCode' => $data['postal_code'],
        //     'key' => 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'
        // ]);

        // $data['user_id'] = Auth::user()->id;

        // $lat = $response->json()['results'][0]['position']['lat'];
        // $lon = $response->json()['results'][0]['position']['lon'];

        // $data['img_url'] = Storage::put('public', $data['img']);



        // $apartment->lat = $lat;
        // $apartment->lon = $lon;

        // $apartment->fill($data);
        $apartment->update($data);

        if(array_key_exists('services', $data)) $apartment->services()->sync($data['services']);

        return redirect()->route('user.apartments.show', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        // DETACH DEI SERVIZI AGGIUNTIVI 
        if($apartment->service)
        {
            $apartment->services()->detach();    
        }
        $apartment->delete();
        // RITORNO ALLA VIEW INDEX E NEL FORM DEL DELETE RITORNO IL NOME DELL'APPARTAMENTO COSì ESCE SCRITTO: APPARTAMENTO ECC ECC ELIMINATO CON SUCCESSO 
        return redirect()->route('user.apartments.index')->with('delete', $apartment->title);
    }
}
