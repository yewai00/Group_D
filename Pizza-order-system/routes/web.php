<?php

use App\Models\Pizza;
use App\Services\PizzaServices;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


use App\Http\Controllers\GraphController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Rider\RiderController;
use App\Http\Controllers\Customer\CustController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\UserCheckMiddleware;
use GuzzleHttp\Middleware;

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



Route::get('/admin', function () {
    return view('Admin.layouts.app');
});


Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.get');

Route::post('/register', [UserController::class, 'submitRegisterForm'])->name('register.post');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.get');

Route::post('/login', [UserController::class, 'submitLoginForm'])->name('login.post');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('forget-password', [UserController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [UserController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//rider crud route
Route::group(['prefix' => 'admin/riders', 'middleware' => [AdminCheckMiddleware::class], 'as' => 'riders.'], function () {
    Route::get('/', [RiderController::class, 'index'])->name('index');

    Route::post('/', [RiderController::class, 'store'])->name('store');

    Route::get('/create', [RiderController::class, 'create'])->name('create');

    Route::put('/{id}', [RiderController::class, 'update'])->name('update');

    Route::delete('/{id}', [RiderController::class, 'destroy'])->name('destroy');

    Route::get('/{id}/edit', [RiderController::class, 'edit'])->name('edit');

    Route::get('/search', [RiderController::class, 'search'])->name('search');

    Route::get('/export', [RiderController::class, 'export'])->name('export');

    Route::get('/upload', [RiderController::class, 'showUploadForm'])->name('upload.get');

    Route::post('/upload', [RiderController::class, 'upload'])->name('upload');
});

Route::group(['prefix' => 'admin', 'middleware' => [AdminCheckMiddleware::class]], function () {
    Route::get('/pizzas/list', [PizzaController::class, 'pizzaList'])->name('admin.pizza.list');

    Route::get('/pizzas/create', [PizzaController::class, 'showNewPizzaForm'])->name('pizza.create.get');

    Route::post('/pizzas/create', [PizzaController::class, 'submitNewPizzaForm'])->name('pizza.create.post');

    Route::get('/pizzas/detail/{id}', [PizzaController::class, 'pizzaDetails'])->name('pizza.detail');

    Route::get('/pizzas/edit/{id}', [PizzaController::class, 'showEditPizzaForm'])->name('pizza.edit.get');

    Route::post('/pizzas/edit/{id}', [PizzaController::class, 'submitEditPizzaForm'])->name('pizza.edit.post');

    Route::get('/pizzas/delete/confirm/{id}', [PizzaController::class, 'showDeletePizzaConfirm'])->name('pizza.delete.get');

    Route::get('/pizzas/delete/{id}', [PizzaController::class, 'deletePizza'])->name('pizza.delete.post');

    Route::post('/pizzas/search', [PizzaController::class, 'searchPizza'])->name('pizza.search');

    Route::get('/pizzas/export', [PizzaController::class, 'export'])->name('pizza.export');

    Route::get('/profile', [UserController::class, 'showAdminProfile'])->name('admin.profile');

    Route::post('/profile/{id}', [UserController::class, 'submitAdminProfile'])->name('admin.profile.post');

    Route::get('/profile/password', [UserController::class, 'showAdminChangePasswordForm'])->name('admin.password.get');

    Route::post('/profile/password/{id}', [UserController::class, 'submitChangePasswordForm'])->name('admin.password.post');

    Route::get('/graph', [GraphController::class, 'graph'])->name('graph');

    Route::get('/users/list/{role_id}', [UserController::class, 'getAllUsersList'])->name('users.list');

    Route::post('/users/search/{role}', [UserController::class, 'search'])->name('user.search');

    Route::get('/users/download/{role}', [UserController::class, 'export'])->name('user.download');

});

// User/ user detail and change password
Route::get('/user/detail', [UserController::class, 'showUserProfile'])->name('user.profile');

Route::post('/user/detail/{id}', [UserController::class, 'submitUserProfile'])->name('user.profile.post');

Route::get('/user/password', [UserController::class, 'showUserChangePasswordForm'])->name('customer.password.get');

Route::post('/user/password/{id}', [UserController::class, 'submitUserChangePasswordForm'])->name('customer.password.post');


Route::group(['prefix' => 'admin', 'middleware' => [AdminCheckMiddleware::class]], function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');

    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');

    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');

    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::post('/categories/search', [CategoryController::class, 'search'])->name('category.search');

    Route::get('/categories/export', [CategoryController::class, 'export'])->name('category.export');

    Route::get('/categories/upload', [CategoryController::class, 'showUploadForm'])->name('category.upload.get');

    Route::post('/categories/upload', [CategoryController::class, 'upload'])->name('category.upload');
});

Route::get('/', [CustController::class, 'index'])->name('cust');

Route::get('/pizzas/search',[CustController::class,'searchPizza'])->name('user.pizza.search');


Route::group(['middleware' => [UserCheckMiddleware::class]], function () {

    Route::get('pizza-detail/{id}', [CustController::class, 'pizzaDetail'])->name('pizzaDeatail');

    Route::get('/cart', [CustController::class, 'cart'])->name('cart');

    Route::post('/contact/mail',[CustController::class,'contactMail'])->name('contact.mail');
});

Route::get('pizza-detail/{id}', [CustController::class, 'pizzaDetail'])->name('pizzaDeatail');
Route::get('/cart', [CustController::class, 'getCart'])->name('cart');
Route::get('/add-item/{id}', [CustController::class, 'getAddToCart']);
Route::get('/minus-item/{id}', [CustController::class, 'minusItem']);
Route::get('/delete-item/{id}', [CustController::class, 'deleteItem']);
Route::get('/session-destroy', [CustController::class, 'sessionDestroy']);
Route::get('order', [CustController::class, 'makeorder']);
