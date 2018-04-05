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

Route::get('dashboard', function () {
    return view('pages/dashboard');
})->name('dashboard');

Route::get('login', function () {
    return view('login');
});

Route::resource('kendaraan','KendaraanController', ['names' => [
    'index' => 'kendaraan'
  ]
]);
Route::get('api/kendaraan','KendaraanController@apikendaraan')->name('api.kendaraan');

Route::resource('storing','StoringController',['names' => [
    'index' => 'storing'
  ]
]);
Route::get('api/storing','StoringController@apistoring')->name('api.storing');

Route::resource('pengeluaran','PengeluaranController',['names' => [
    'index' => 'pengeluaran'
  ]
]);
Route::get('api/pengeluaran','PengeluaranController@apipengeluaran')->name('api.pengeluaran');

Route::resource('invoice','InvoiceController',['names' => [
    'index' => 'invoice'
  ]
]);
Route::get('api/invoice','InvoiceController@apiinvoice')->name('api.invoice');

Route::resource('users','UsersController',['names' => [
    'index' => 'users',
    'save' => 'save'
  ]
]);
Route::post('users/save','UsersController@save')->name('users.save');
Route::delete('users/delete/{user}','UsersController@delete')->name('users.delete');
Route::get('users/{user}/change','UsersController@change')->name('users.change');
Route::patch('users/improve/{user}','UsersController@improve')->name('users.improve');
Route::get('api/user','UsersController@apiuser')->name('api.user');
Route::get('api/mekanik','UsersController@apimekanik')->name('api.mekanik');

Route::resource('jenis','JenishargaController',['names' => [
    'index' => 'jenis',
    'save' => 'save'
  ]
]);
Route::post('harga/save','JenishargaController@save')->name('harga.save');
Route::delete('harga/delete/{harga}','JenishargaController@delete')->name('harga.delete');
Route::get('harga/{harga}/change','JenishargaController@change')->name('harga.change');
Route::patch('harga/improve/{harga}','JenishargaController@improve')->name('harga.improve');
Route::get('api/jenis','JenishargaController@apijenis')->name('api.jenis');
Route::get('api/harga','JenishargaController@apiharga')->name('api.harga');

Route::resource('kamadjaya','KamadjayaController', ['names' => [
    'index' => 'kamadjaya'
  ]
]);
Route::get('api/kamadjaya','KamadjayaController@apikamadjaya')->name('api.kamadjaya');
