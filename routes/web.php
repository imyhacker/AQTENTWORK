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
Route::prefix('/home/data')->group(function($slugcatatan = null){
    Route::get('/carimikrotik', [HomeController::class, 'carimikrotik'])->name('carimikrotik');
    Route::post('/carimikrotik/cari', [HomeController::class, 'cari'])->name('cari');
    Route::get('/mikrotik', [HomeController::class, 'mikrotik'])->name('mikrotik');
});
