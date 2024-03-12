<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'PageController@index')->name('pages.index');
    Route::get('/dashboard', 'PageController@dashboard')->name('pages.dashboard');
    Route::get('/data-anak', 'PageController@data_anak')->name('pages.data_anak');
    Route::get('/data-ibu', 'PageController@data_ibu')->name('pages.data_ibu');
    Route::get('/data-imunisasi', 'PageController@data_imunisasi')->name('pages.data_imunisasi');
    Route::get('/riwayat-imunisasi', 'PageController@riwayat_imunisasi')->name('pages.riwayat_imunisasi');
    Route::get('/jadwal', 'PageController@jadwal')->name('pages.jadwal');
    Route::get('/penimbangan', 'PageController@penimbangan')->name('pages.penimbangan');
    Route::get('/artikel', 'PageController@artikel')->name('pages.artikel');
    Route::get('/settings', 'PageController@settings')->name('pages.settings');
});