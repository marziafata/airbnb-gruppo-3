<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function sponsors() {
        return $this->belongToMany('App\Sponsor');
    }

    public function services() {
        return $this->belongToMany('App\Service');
    }
}