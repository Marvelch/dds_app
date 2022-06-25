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
    Route::delete('/cash_in/delete/{id}', [KasMasukController::class, 'deleteKasMsk']); // Delete all data from kasmsk 

    // Page edit 
    Route::get('/info/get-temporary-kas-masuk/{id}', [KasMasukController::class, 'get_temporary_edit_kas_masuks']);
    Route::get('/info/get-temporary-cek-masuk/{id}', [KasMasukController::class, 'get_temporary_edit_cek_masuks']);

    Route::get('/info/get-data/kas-msk/', [KasMasukController::class, 'get_detail_one_record_kas_masuk']);
    Route::get('/info/get-opponents-edit/{id}',  [KasMasukController::class, 'get_opponent_edit']);
    Route::post('/cash-in/edit/temp/one-field/{id}', [KasMasukController::class, 'save_temp_edit_kasmsk']);

    // Pop up form submit 
    Route::post('/cash-in/edit/detail-1/submit/{kasmsk}', [KasMasukController::class, 'push_temp_kasmsk_edit']);
    Route::post('/cash-in/edit/detail-2/submit/{kasmsk}', [KasMasukController::class, 'push_temp_cekmsk_edit']);

    // Delete form edit page
    Route::delete('/cash_in/edit/kasmsk/delete/{id}', [KasMasukController::class, 'cash_in_delete_kasmsk1']); //soft delete
    Route::delete('/cash_in/edit/cekmsk/delete/{id}', [KasMasukController::class, 'cash_in_delete_cekmsk']); //soft delete

    Route::delete('/cash_in/edit/detail-1/delete/{id}', [KasMasukController::class, 'cash_in_delete_detail_1']);
    Route::delete('/cash_in/edit/detail-2/delete/{id}', [KasMasukController::class, 'cash_in_delete_detail_2']);

    // Datatable get edit page
    // Route::get('/edit/get_temp_edit_kasmsk/', [KasMasukController::class, 'get_temp_edit_kasmsk']); Matikan karena ganti fitur
    // Route::get('/edit/get_temp_edit_cekmsk/', [KasMasukController::class, 'get_temp_edit_cekmsk']); Matikan karena ganti fitur
    Route::put('/general_edit_cash_in/{id}/{kasmsk}', [KasMasukController::class, 'general_edit_cash_in']);
});

Route::group(['prefix' => 'operator', 'middleware' => 'is_level'], function () {
    Route::get('testing', function () {
        return view('operator.home');
    })->name('testing');
});
