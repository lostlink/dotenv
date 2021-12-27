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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('project', \App\Http\Controllers\ProjectController::class);

//    Route::view('forms', 'forms')->name('forms');
//    Route::view('cards', 'cards')->name('cards');
//    Route::view('charts', 'charts')->name('charts');
//    Route::view('buttons', 'buttons')->name('buttons');
//    Route::view('modals', 'modals')->name('modals');
//    Route::view('tables', 'tables')->name('tables');
//    Route::view('calendar', 'calendar')->name('calendar');
});
