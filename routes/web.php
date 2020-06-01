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

Auth::routes();


// CONTACTS
Route::resource('contact', 'ContactController');
Route::get('contacts/{contact}/track', 'ContactController@track')->name('contact.track');
Route::post('contacts/csvImport', 'ContactController@csvImport')->name('contact.csvImport');
