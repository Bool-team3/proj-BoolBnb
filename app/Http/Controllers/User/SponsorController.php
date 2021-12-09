<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('user.sponsors.index', compact('sponsors', 'apartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
    
        $apartment = Apartment::find($data['apartment_id']);
        $sponsor = Sponsor::find($data['sponsor_id']);
        
        
        
    
        if($apartment->sponsors()->exists('expiration_date')){

            foreach ($apartment->sponsors as $sponsor) {
                $addTime = $sponsor->pivot->expiration_date;
            }
    
            $date = new Carbon($addTime);

            $apartment->sponsors()->sync([$data['sponsor_id'] => 
                ["expiration_date" => $date->addDays($sponsor->time)]]);
        }else{
            $apartment->sponsors()->sync([$data['sponsor_id'] => 
                ["expiration_date" => Carbon::now()->addDays($sponsor->time)]]);
        }

        return redirect()->route('user.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($apartment)
    {
        // dd($apartment);
        $sponsors = Sponsor::all(); 

        return view('user.sponsors.show', compact('sponsors', 'apartment'));
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
