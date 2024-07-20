<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes(['register' => false]);

Route::get('/home', [DashboardController::class, 'index'])->name('home');

Route::group(["prefix" => 'cp', 'middleware' => 'auth', 'as' => 'cp.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/create', [DashboardController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [DashboardController::class, 'edit'])->where('id', '[0-9]+')->name('edit');
});
