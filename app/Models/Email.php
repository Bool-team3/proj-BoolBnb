<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['name','email_address', 'subject', 'message'];

    public function apartment(){
        return $this->belongsTo("App\Models\Apartment");
    }
}
