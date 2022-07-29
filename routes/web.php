<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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

Auth::routes();

Route::get('/', [IndexController::class, 'main']);
Route::get('/type/{type}', [IndexController::class, 'type'])->name('type');
Route::get('/home', [IndexController::class, 'home'])->name('home')->middleware('auth');

Route::post('/unsubscribe/{timetable}', [IndexController::class, 'unsubscribe'])->name('unsubscribe')->middleware('auth');
Route::get('/confirm/{timetable}', [IndexController::class, 'confirm'])->name('confirm')->middleware('auth');
Route::post('/subscribe/{timetable}/{master_class}', [IndexController::class, 'subscribe'])->name('subscribe')->middleware('auth');

Route::delete('/delete/{timetable}', [IndexController::class, 'delete'])->name('delete')->middleware('auth');
Route::delete('/delete_master_class/{master_class}', [IndexController::class, 'delete_master_class'])->name('delete_master_class')->middleware('auth');
Route::get('/add', [IndexController::class, 'add'])->middleware('auth');
Route::post('/add', [IndexController::class, 'store'])->name('store')->middleware('auth');
Route::get('/change/{timetable}', [IndexController::class, 'change'])->name('change')->middleware('auth');
Route::post('/edit/{timetable}', [IndexController::class, 'edit'])->name('edit')->middleware('auth');

