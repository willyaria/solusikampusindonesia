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

Route::get('/home', [App\Http\Controllers\Instansi::class, 'index'])->name('home');
Route::get('/listInstansi', [App\Http\Controllers\Instansi::class, 'indexInstansi'])->name('home');
Route::post('/createInstansi', [App\Http\Controllers\Instansi::class, 'simpanInstansi'])->name('home');
Route::get('/hapusInstansi/{id}', [App\Http\Controllers\Instansi::class, 'deleteInstansi'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
