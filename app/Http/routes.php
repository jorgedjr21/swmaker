<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',[
    'as'=>'index',
    'uses' => 'AppController@index']);


Route::post('/signup',[
    'as'=> 'site.storeEmail',
    'uses' => 'AppController@storeEmail'
]);

Route::post('/api/send',[
    'as' => 'api.send',
    'uses' => 'ApiController@store'
]);

Route::post('/api/switchLight',[
    'as'    =>  'api.switchLight',
    'uses' =>   'ApiController@switchLight'
]);

Route::get('/api/get',[
    'as' => 'api.get',
    'uses'=> 'ApiController@show'
]);

Route::get('/api/onoff',[
    'as'   =>   'api.onoff',
    'uses'  =>  'ApiController@index'
]);

Route::get('/dashboard',[
    'as' =>  'app.dashboard',
    'uses'  => 'AppController@dashboard'
]);

Route::get('/api/getData',[
    'as'=>'api.getData',
    'uses' => 'ApiController@getData'    
]);

Route::get('/api/getLastHourData',[
    'as'=>'api.getLastHourData',
    'uses' => 'ApiController@getLastHourData'    
]);