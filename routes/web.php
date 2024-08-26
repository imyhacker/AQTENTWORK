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

Route::prefix('/home/data')->group(function($slugcatatan = null, $idm = null, $address = null, $restartkoneksi = null, $name = null){

    // MIKROTIK
    Route::get('/carimikrotik', [HomeController::class, 'carimikrotik'])->name('carimikrotik');
    Route::get('/datamikrotik', [HomeController::class, 'datamikrotik'])->name('datamikrotik');

    Route::get('/carimikrotik/cari', [HomeController::class, 'cari'])->name('cari');

    // FITUR MIKROTIK
    Route::post('/carimikrotik/cari/{slugcatatan}/remotemodem', [HomeController::class, 'remotemodem'])->name('remotemodem');
    Route::get('/carimikrotik/cari/{name}/{slugcatatan}/restartkoneksi', [HomeController::class, 'restartkoneksi'])->name('restartkoneksi', $restartkoneksi, $name);

    // OLT
    Route::get('/cariolt', [HomeController::class, 'cariolt'])->name('cariolt');

    // FITUR OLT
    Route::post('/cariolt/cari', [HomeController::class, 'caridataolt'])->name('caridataolt');


    // Neighbor
    Route::get('/carimikrotikneighbor', [HomeController::class, 'carimikrotikneighbor'])->name('carimikrotikneighbor');
    Route::get('carimikrotikneighbor/carimn', [HomeController::class, 'carimn'])->name('carimn');

 Route::get('/cariinterface', [HomeController::class, 'cariinterface'])->name('cariinterface');
 Route::get('/cariinterface/cariinterfacedata', [HomeController::class, 'cariinterfacedata'])->name('cariinterfacedata');
    // Schedule
    Route::get('/carishcedule', [HomeController::class, 'carishcedule'])->name('carishcedule');
    Route::get('/carischedule/carish', [HomeController::class, 'carish'])->name('carish');

   
});
