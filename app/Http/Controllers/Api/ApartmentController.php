<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{

    public function all(){
        
        $apartment = Apartment::search()->with([
            'filters' => 'room = 2',
            'aroundLatLng' => '‎45.4773, 9.1815',
            'aroundRadius' => 10000000,
            'hitsPerPage' => 100])->get();

            
        // $apartments = Apartment::all()->where('status', '1');

        return response()->json($apartment);
    }

    public function sponsored(){
        $oggi = date("Y/m/d");
        $apartments = DB::table('apartments')
            ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where([
                ['status', '=', '1'],
                ['end_date', '>', $oggi],
                ])
            ->get();
            return response()->json($apartments);
    }
}
