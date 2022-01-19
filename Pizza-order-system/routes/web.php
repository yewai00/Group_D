<?php

use App\Models\Pizza;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rider\RiderController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\Customer\CustController;
use App\Http\Controllers\UserController;

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



Route::get('/register',[UserController::class,'showRegisterForm'])->name('register.get');

Route::post('/register',[UserController::class,'submitRegisterForm'])->name('register.post');

Route::get('/login',[UserController::class,'showLoginForm'])->name('login.get');

Route::post('/login',[UserController::class,'submitLoginForm'])->name('login.post');

Route::get('/logout',[UserController::class,'logout'])->name('logout');





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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/pizzas/list', [PizzaController::class, 'pizzaList'])->name('admin.pizza.list');

    Route::get('/pizzas/create', [PizzaController::class, 'showNewPizzaForm'])->name('pizza.create.get');

    Route::post('/pizzas/create', [PizzaController::class, 'submitNewPizzaForm'])->name('pizza.create.post');

    Route::get('/pizzas/detail/{id}', [PizzaController::class, 'pizzaDetails'])->name('pizza.detail');

    Route::get('/pizzas/edit/{id}', [PizzaController::class, 'showEditPizzaForm'])->name('pizza.edit.get');

    Route::post('/pizzas/edit/{id}', [PizzaController::class, 'submitEditPizzaForm'])->name('pizza.edit.post');

    Route::get('/pizzas/delete/confirm/{id}', [PizzaController::class, 'showDeletePizzaConfirm'])->name('pizza.delete.get');

    Route::get('/pizzas/delete/{id}', [PizzaController::class, 'deletePizza'])->name('pizza.delete.post');

    Route::post('/pizzas/search',[PizzaController::class,'searchPizza'])->name('pizza.search');
});

//user
    Route::get('/', [CustController::class, 'index'])->name('cust');
