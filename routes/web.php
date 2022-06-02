<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;

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

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {

    // Route Group Kas Masuk
    Route::resource('cash_list', KasMasukController::class);
    Route::get('add_cash_in', [KasMasukController::class, 'addCashIn']);
    Route::get('get_cash', [KasMasukController::class, 'getCashIn']);
    Route::get('get_opponent/{id}', [KasMasukController::class, 'getOpponent']);
    Route::post('submit_detail_opponent', [KasMasukController::class, 'postKasMasuk']);
    Route::get('get_kas_masuk_opponent', [KasMasukController::class, 'getKasMasuk']);
    Route::post('post_cek_masuk', [KasMasukController::class, 'postCekMasuk']);
    Route::get('get_cek_masuk', [KasMasukController::class, 'getCekMasuk']);
    Route::post('post_all_oppenent', [KasMasukController::class, 'postAllRequest']);

    // Page view kasmsk 
    Route::get('/info/cash_in/{id}', [KasMasukController::class, 'getDetail']);
    Route::get('/info/cash_in/first/{id}', [KasMasukController::class, 'getFirstDetail']);
    Route::get('/info/cash_in/second/{id}', [KasMasukController::class, 'getSecondDetail']);
    Route::delete('/cash_in/delete/{id}', [KasMasukController::class, 'deleteKasMsk']);

    // Page edit 
    Route::get('/info/cash_in/edit/first/{id}', [KasMasukController::class, 'getEditFirstDetail']);
    Route::get('/info/cash_in/edit/second/{id}', [KasMasukController::class, 'getEditSecondDetail']);
    Route::delete('cash_in/first/delete/{id}', [KasMasukController::class, 'delKasMsk1']);
    Route::post('/submit_detail_opponent/edit/', [KasMasukController::class, 'push_temp_kasmsk_edit']);
    Route::get('/edit/get_temp_edit_kasmsk/', [KasMasukController::class, 'get_temp_edit_kasmsk']);
    Route::get('/edit/get_temp_edit_cekmsk/', [KasMasukController::class, 'get_temp_edit_cekmsk']);
    Route::post('/submit/edit/cek_masuk/', [KasMasukController::class, 'push_temp_cekmsk_edit']);
    Route::put('/general_edit_cash_in/{id}/{kasmsk}', [KasMasukController::class, 'general_edit_cash_in']);
});

Route::group(['prefix' => 'operator', 'middleware' => 'is_level'], function () {
    Route::get('testing', function () {
        return view('operator.home');
    })->name('testing');
});
