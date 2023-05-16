<?php

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

Route::get('/', function () {
    //return view('auth/login');
    if (Auth::check()) {
return view('drones/create');
  }
else{
  return view('auth/login');
    }
});

Auth::routes();

//Route::get('/register', 'RegisterController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('drones', 'DroneController');

Route::view('/submit', 'insert_data');

Route::get('insert_bop', 'DroneController@Insert_bop')->name('drones.insert_bop');

Route::get('submit_bop', 'DroneController@Submit_bop')->name('drones.submit_bop');

Route::get('drone_map', 'DroneController@DroneMap')->name('drones.drone_map');

Route::get('get-category-data', 'DroneController@categoryData')->name('datatables.category');
