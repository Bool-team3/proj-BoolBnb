<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Apartment extends Model
{
    use SoftDeletes;
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
