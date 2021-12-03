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

    public function services(){
        return $this->belongsToMany('App\Models\Service');
    }

    public function sponsors(){
        return $this->belongsToMany('App\Models\Sponsor');
    }
}
