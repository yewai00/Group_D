<?php

use App\Models\Pizza;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;

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
