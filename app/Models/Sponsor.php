<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = ['name', 'price', 'rank', 'time'];

    public function apartments(){
        return $this->belongsToMany('App\Models\Apartment')->withPivot("expiration_date");
    }
}
