<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
})->name('login');

// Route::resource('reserva', "App\Http\Controllers\ReserveController")->middleware('auth');
Route::get('reserva', "App\Http\Controllers\ReserveController@index")->name('reserva.index')->middleware('auth');
Route::get('reserva/create', "App\Http\Controllers\ReserveController@create")->name('reserva.create')->middleware('auth');
Route::post('reserva/store', "App\Http\Controllers\ReserveController@store")->name('reserva.store')->middleware('auth');
Route::get('/reserves/{id}', "App\Http\Controllers\ReserveController@getReserves")->middleware('auth');

Route::get('registro', "App\Http\Controllers\RegisterController@index")->name('registro.index');
Route::post('registro/store',  "App\Http\Controllers\RegisterController@store")->name('registro.store');
Route::get('/contact_accept/{code}', 'App\Http\Controllers\RegisterController@verifyEmail');

Route::get('perfil', 'App\Http\Controllers\ProfileController@index')->name('perfil.index')->middleware('auth');
Route::post('perfil/foto', 'App\Http\Controllers\ProfileController@updatePic')->name('perfil.photo')->middleware('auth');
Route::post('perfil/password', 'App\Http\Controllers\ProfileController@updatePassword')->name('perfil.password')->middleware('auth');

//Lab routes
Route::get('actividad/{id}', 'App\Http\Controllers\ActivityController@index')->name('activity.index')->middleware('auth');
Route::get('/credenciales/{id}', 'App\Http\Controllers\ActivityController@sendCredentials')->name('credentials')->middleware('auth');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\ReserveController::class, 'index'])->name('home');
