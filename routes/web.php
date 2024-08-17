<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepanController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::prefix('/')->group(function () {
    Route::get('/', [DepanController::class, 'index'])->name('index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home/postmikrotik', [HomeController::class, 'postmikrotik'])->name('postmikrotik');
Route::post('/home/postolt', [HomeController::class, 'postolt'])->name('postolt');

Route::prefix('/home/data')->group(function($slugcatatan = null, $idm = null, $address = null, $restartkoneksi = null){

    Route::get('/carimikrotik', [HomeController::class, 'carimikrotik'])->name('carimikrotik');
    
    Route::post('/carimikrotik/cari', [HomeController::class, 'cari'])->name('cari');
  
    // FITUR
    Route::post('/carimikrotik/cari/{slugcatatan}/remotemodem', [HomeController::class, 'remotemodem'])->name('remotemodem', $slugcatatan);
    Route::get('/carimikrotik/cari/{idm}/{slugcatatan}/restartkoneksi', [HomeController::class, 'restartkoneksi'])->name('restartkoneksi', $restartkoneksi, $idm);


    Route::get('/cariolt', [HomeController::class, 'cariolt'])->name('cariolt');
    Route::post('/cariolt/cari', [HomeController::class, 'caridataolt'])->name('caridataolt');

    Route::get('/mikrotik', [HomeController::class, 'mikrotik'])->name('mikrotik');
});
