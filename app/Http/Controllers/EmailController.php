<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Email;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name'=> 'required|string|max:25|',
            'email_address' => 'required|email:rfc,dns',
            'subject' => 'required|string|max:60',
            'message' => 'required|string'
        ]);

        $data = $request->all();

        // dd($data);
        $email = new Email();
        $email->apartment_id = $data['apartment_id'];
        $email->fill($data);
        $email->save();

        return redirect()->route('home')->with('message-success', 'Messaggio inviato correttamente!');
    }
}
