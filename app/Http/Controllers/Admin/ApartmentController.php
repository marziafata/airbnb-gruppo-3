<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    // public function __construct() {
    //     $this->middleware('auth'); //->except('index') oppure ->only('index')
    // }


     public function index()
    {
        $id = Auth::id();
        $apartments = Apartment::all()->where('user_id', $id);
        $data = [
            'apartments' => $apartments
        ];
        return view('admin.apartments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:2000',
            'address' => 'required|max:150',
            'room' => 'numeric|max:10',
            'bath' => 'required|numeric|max:10',
            'square_meters' => 'required|numeric|max:1000',
        ]);

        $id = Auth::id();
        $dati = $request->all();
        $dati['user_id'] = $id;
        $apartment = new Apartment();
        $apartment->fill($dati);
        $apartment->save();
        if(!empty($dati['services'])) {
         $apartment->services()->sync($dati['services']);
        }
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::find($id);
        if($apartment){
            $data = [
                'apartment' => $apartment
            ];
            return view('admin.apartments.show', $data);
        }else{
             return abort('404');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::find($id);
        if($apartment) {
           $services = Service::all();
           $data = [
               'apartment' => $apartment,
               'services' => $services
           ];
           return view('admin.apartments.edit', $data);
        } else {
           return abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:2000',
            'room' => 'required|numeric|max:10',
            'bath' => 'required|numeric|max:10',
            'square_meters' => 'required|numeric|max:1000',
        ]);

        $dati = $request->all();
        $apartment = Apartment::find($id);
        $apartment->update($dati);
        if(!empty($dati['services'])) {
            $apartment->services()->sync($dati['services']);
        }else{
            $apartment->services()->detach();
        }
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        if($apartment) {
            $apartment->delete();
            return redirect()->route('admin.apartments.index');
        } else {
            return abort('404');
        }
    }
}
