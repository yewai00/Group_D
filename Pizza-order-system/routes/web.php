<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rider\RiderController;

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

Route::get('/admin/categories', function () {
    return view('Admin.layouts.app');
});

//rider crud route
Route::prefix('admin/riders')->name('riders.')->group(function () {
    Route::get('/', [RiderController::class, 'index'])->name('index');
    Route::post('/', [RiderController::class, 'store'])->name('store');
    Route::get('/create', [RiderController::class, 'create'])->name('create');
    Route::put('/{id}', [RiderController::class, 'update'])->name('update');
    Route::delete('/{id}', [RiderController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/edit', [RiderController::class, 'edit'])->name('edit');
    Route::get('/search', [RiderController::class, 'search'])->name('search');
});