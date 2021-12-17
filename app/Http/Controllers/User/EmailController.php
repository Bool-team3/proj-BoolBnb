<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //prende solo gli appartamenti dell utente loggato
        $apartments = Apartment::where('user_id', Auth::user()->id)->get();
        $userApartments = $apartments->pluck('id')->toArray();

        $data = $request->all();
        if(array_key_exists('apartments', $data)){
            if($data['apartments'][0] == null){
                //trasforma gli id presi in un array
                $userApartments = $apartments->pluck('id')->toArray();
            }else{
                $userApartments = $data;
            }
        }

        $data = "";
        
        $emails = Email::whereIn('apartment_id', $userApartments)->paginate(7);
        $emailsCount = Email::whereIn('apartment_id', $userApartments)->get();

        
        $allEmail = count($emailsCount);

        return view('user.emails.index', compact('emails', 'allEmail', 'apartments'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return view('user.emails.show', compact('email'));
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
    public function destroy(Email $email)
    {
        $email->delete();
       
        return redirect()->route('user.emails.index')->with('delete', $email->subject);
    }
}
