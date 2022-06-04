<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Kendaraan\Kendaraan;
use App\Http\Livewire\Pesanan\Pesanan;
use App\Http\Livewire\Log\LogData;
use App\Http\Livewire\Dashboard;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
	Route::get('/dashboard', Dashboard::class)->name('dashboard');
	Route::get('pesanan', Pesanan::class)->name('pesanan');
	Route::get('log', LogData::class)->name('log');
});
//Route Admin Role
Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => ['auth:sanctum','admin']], function(){
	Route::get('kendaraan', Kendaraan::class)->name('kendaraan');
});