<?php


use Illuminate\Support\Facades\Route;

Route::get('/person/list','App\Http\Controllers\Api\V1\PersonController@listAction')->name('PersonList');

Route::get('/person/view/{id}','App\Http\Controllers\Api\V1\PersonController@viewAction')->name('PersonView');

Route::post('/person/create','App\Http\Controllers\Api\V1\PersonController@createAction')->name('PersonCreate');

Route::put('/person/update','App\Http\Controllers\Api\V1\PersonController@updateAction')->name('PersonUpdate');

Route::delete('/person/delete/{id}','App\Http\Controllers\Api\V1\PersonController@deleteAction')->name('PersonDelete');


