<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use Searchable;

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array = $this->transform($array);
        $array['_geoloc'] = [
            'lat' => $this->latitude,
            'lng' => $this->longitude
        ];
        $array['user_name'] = $this->user->name;
        return $array;
    }

    protected $fillable = ['title', 'description', 'room', 'address', 'bath', 'square_meters', 'latitude', 'longitude', 'image_url', 'status', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function sponsors() {
        return $this->belongsToMany('App\Sponsor');
    }

    public function services() {
        return $this->belongsToMany('App\Service');
    }
}
