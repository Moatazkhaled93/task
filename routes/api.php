<?php

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

use Illuminate\Support\Facades\Artisan;

//Route::post('/git-deploy', function () {
//    Artisan::call("git:deploy");
//    exit;
//});

Route::middleware('guest')->group(function () {
    // @TODO: Login not required as there is a oauth endpoint oauth/token to request tokens for accessing the API using username/password
    Route::get('clients', 'Api\ClientsController@index')->name('clients');
    Route::get('clients/{id}', 'Api\ClientsController@show')->name('clients');
    Route::post('clients', 'Api\ClientsController@store')->name('clients');
    Route::put('clients/{id}', 'Api\ClientsController@update')->name('clients');
    Route::delete('clients/{id}', 'Api\ClientsController@destroy')->name('clients');
    

});
