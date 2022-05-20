<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\UsersController;

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

Route::get('/tamplate', function () {
    return view('dashboard');
});

Route::group(['prefix' => 'users', 'middleware' => 'web'], function () {

    // Route Group Kas Masuk

    Route::resource('cash_list', KasMasukController::class);
    Route::get('add_cash_in', [KasMasukController::class, 'addNew']);

    Route::get('get_cash', [KasMasukController::class, 'getCashIn']);

    Route::get('get_opponent', function () {
        return view('kasmasuk.opponent');
    });
});

Route::get('penggilan', function () {
    return view('layouts.app');
});
