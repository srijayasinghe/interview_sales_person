<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/sales/person/add','App\Http\Controllers\SalesController@addSalesPersonAction')->name('addSalesPerson');

Route::get('/sales/person/list','App\Http\Controllers\SalesController@listProductAction')->name('listSalesPerson');

Route::get('/sales/person/edit/{id}','App\Http\Controllers\SalesController@editProductAction')->name('editSalesPerson');


Route::get('/sales/person/editform/{id}','App\Http\Controllers\SalesController@editFormProductAction')->name('editFormSalesPerson');

