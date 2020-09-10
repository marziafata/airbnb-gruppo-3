<?php

use Illuminate\Support\Facades\Route;
//aggiungo per sfruttare la funzione request facade di laravel
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//rotte pubbliche
Route::get('/', 'HomeController@index')->name('home');
Route::get('/show/{apartment}', 'ApartmentController@show')->name('show');
Route::post('/show/{apartment}', 'ApartmentController@sendmessage')->name('storemessage');
Route::post('/search', 'HomeController@search')->name('search');
// Route::get('/search', function() {
//     $query = ''; // <-- Change the query for testing.

//     $apartment = App\Apartment::search($query)->get();

//     return $apartment;
// });

//Rotta che mappa la home page dell'amministratore
Route::prefix('admin')
->namespace('Admin')
->name('admin.')
->middleware('auth')
->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/message', 'HomeController@readmessage')->name('message');
    Route::resource('/apartments', 'ApartmentController');
    Route::get('/statistics/{apartment}', 'ApartmentController@statistics')->name('statistics');
});


//avatar
Route::post('/upload', 'UserController@uploadAvatar');

// //image
// Route::post('/uploads', 'ApartmentController@uploadImage');
