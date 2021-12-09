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
        // $apartment = Apartment::where('id', $data['apartment_id'])->get();

        // $sponsors = new Sponsor();
        $sponsors = Sponsor::find(1);
        // dd($apartment->sponsor());

        // $sponsors->apartments()->sync([1 => [ 'apartment_id' => $data['apartment_id'] ], 2 => ['expiration_date'] => $sponsors->time ]);
        
        // dd($sponsors->apartments());
        // dd($sponsors->time);

        // if(array_key_exists('sponsors', $data)) $apartment->sponsors()->sync($data['sponsors']);

        $sponsors->apartments()->sync([['apartment_id' => $data['apartment_id']], ['expiration_date' => Carbon::now()->addDays($sponsors->time)]]);

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
