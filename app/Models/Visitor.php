<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['date','ip'];
    
    public function apartment(){
        return $this->belongsTo("App\Models\Apartment");
    }
}
