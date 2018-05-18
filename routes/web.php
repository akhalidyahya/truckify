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

Route::get('/',function(){
    return redirect('login');
});

Route::get('login', 'LoginController@index')->name('login');
Route::post('validate', 'LoginController@login')->name('validate');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::get('dashboard', 'DashboardController@index')->name('dashboard');

// Export or Import Excel
Route::get('kendaraan/export','KendaraanController@export')->name('kendaraan.export');
Route::post('kendaraan/import','KendaraanController@import')->name('kendaraan.import');
Route::get('storing/export','StoringController@export')->name('storing.export');
Route::post('storing/import','StoringController@import')->name('storing.import');
Route::get('pengeluaran/export','PengeluaranController@export')->name('pengeluaran.export');
Route::post('pengeluaran/import','PengeluaranController@import')->name('pengeluaran.import');
Route::get('invoice/export','InvoiceController@export')->name('invoice.export');
Route::post('invoice/import','InvoiceController@import')->name('invoice.import');
Route::get('kamadjaya/export','KamadjayaController@export')->name('kamadjaya.export');
Route::post('kamadjaya/import','KamadjayaController@import')->name('kamadjaya.import');
Route::get('datascript/export','DataScriptConttroller@export')->name('datascript.export');
Route::post('datascript/import','DataScriptConttroller@import')->name('datascript.import');
Route::get('sogood/export','SogoodController@export')->name('sogood.export');
Route::post('sogood/import','SogoodController@import')->name('sogood.import');

Route::resource('kendaraan','KendaraanController', ['names' => [
    'index' => 'kendaraan',
    'import' =>'import'
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

Route::resource('kamadjaya','KamadjayaController', ['names' => [
    'index' => 'kamadjaya'
  ]
]);
Route::get('api/kamadjaya','KamadjayaController@apikamadjaya')->name('api.kamadjaya');

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

Route::resource('datascript','DataScriptConttroller',['names' => [
    'index' => 'datascript'
  ]
]);
Route::get('api/datascript','DataScriptConttroller@apidatascript')->name('api.datascript');
Route::get('datascript/jenis/{jenis}/daerah/{daerah?}','DataScriptConttroller@harga')->name('harga.datascript');

// Route::resource('sogood','SogoodController',['names' => [
//     'index' => 'sogood'
//   ]
// ]);
// Route::get('api/sogood','SogoodController@apisogood')->name('api.sogood');
