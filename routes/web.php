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
   // auth()->user()->assignRole('user');
    return view('welcome');
});
Route::get('/grafana', function () {
    // auth()->user()->assignRole('user');
     return view('grafana');
 });
