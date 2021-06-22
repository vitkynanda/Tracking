<?php

use App\Http\Livewire\Container\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DeliveryController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    //Container
    Route::get('/container', \App\Http\Livewire\Container\Index::class)->name('container.index');
    Route::get('/container/create', \App\Http\Livewire\Container\Create::class)->name('container.create');
    Route::get('/container/{id}', \App\Http\Livewire\Container\Edit::class)->name('container.edit');
    //Client
    Route::get('/client', \App\Http\Livewire\Client\Index::class)->name('client.index');
    Route::get('/client/create', \App\Http\Livewire\Client\Create::class)->name('client.create');
    Route::get('/client/{id}', \App\Http\Livewire\Client\Edit::class)->name('client.edit');
    //Origin
    Route::get('/origin', \App\Http\Livewire\Origin\Index::class)->name('origin.index');
    Route::get('/origin/create', \App\Http\Livewire\Origin\Create::class)->name('origin.create');
    Route::get('/origin/{id}', \App\Http\Livewire\Origin\Edit::class)->name('origin.edit');
    //Destination
    Route::get('/destination', \App\Http\Livewire\Destination\Index::class)->name('destination.index');
    Route::get('/destination/create', \App\Http\Livewire\Destination\Create::class)->name('destination.create');
    Route::get('/destination/{id}', \App\Http\Livewire\Destination\Edit::class)->name('destination.edit');
    //Delivery
    Route::get('/delivery', \App\Http\Livewire\Delivery\Index::class)->name('delivery.index');
    Route::get('/delivery/create', \App\Http\Livewire\Delivery\Create::class)->name('delivery.create');
    Route::get('/delivery/{id}', \App\Http\Livewire\Delivery\Edit::class)->name('delivery.edit');
    Route::get('/delivery/history/{id}', \App\Http\Livewire\Delivery\History::class)->name('delivery.history');
    //Packing
    Route::get('/packing', \App\Http\Livewire\Packing\Index::class)->name('packing.index');
    Route::get('/packing/create', \App\Http\Livewire\Packing\Create::class)->name('packing.create');
    Route::get('/packing/{id}', \App\Http\Livewire\Packing\Edit::class)->name('packing.edit');
    //Good
    Route::get('/good', \App\Http\Livewire\Good\Index::class)->name('good.index');
    Route::get('/good/create', \App\Http\Livewire\Good\Create::class)->name('good.create');
    Route::get('/good/{id}', \App\Http\Livewire\Good\Edit::class)->name('good.edit');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

