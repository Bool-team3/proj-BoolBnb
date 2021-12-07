<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Apartment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'room', 'bathroom', 'bedroom', 'bed', 'mq', 'img_url', 'visible', 'street_name', 'street_number', 'city', 'province', 'postal_code', 'lat', 'lon'];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service');
    }

    public function sponsors(){
        return $this->belongsToMany('App\Models\Sponsor')->withPivot("expiration_date");
    }

    public function emails(){
        return $this->hasMany("App\Models\Email");
    }

    public function visitors(){
        return $this->hasMany("App\Models\Visitor");
    }

    public function getImagePrefix(){
        if (str_starts_with($this->img_url, "public")){
            return asset("storage") . "/";
        }
        return "";
    }
}
