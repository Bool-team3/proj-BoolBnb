<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name','email_address', 'subject', 'message'];

    public function apartment(){
        return $this->belongsTo("App\Models\Apartment");
    }
}
