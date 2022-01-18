<?php

use App\Models\Pizza;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CategoryController;


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


Route::group(['prefix' => 'admin'], function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');

    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');

    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');

    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::post('/categories/search', [CategoryController::class, 'search'])->name('category.search');
});
