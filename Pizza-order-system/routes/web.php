<?php

use App\Models\Pizza;
use GuzzleHttp\Middleware;
use App\Services\PizzaServices;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\UserCheckMiddleware;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Controllers\Rider\RiderController;
use App\Http\Controllers\Customer\CustController;

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

    Route::post('/create', [RiderController::class, 'store'])->name('store');

    Route::get('/create', [RiderController::class, 'create'])->name('create');

    Route::put('/{id}', [RiderController::class, 'update'])->name('update');

    Route::delete('/{id}/delete', [RiderController::class, 'destroy'])->name('destroy');

    Route::get('/{id}/edit', [RiderController::class, 'edit'])->name('edit');

    Route::get('/search', [RiderController::class, 'search'])->name('search');

    Route::get('/export', [RiderController::class, 'export'])->name('export');

    Route::get('/upload', [RiderController::class, 'showUploadForm'])->name('upload.get');

    Route::post('/upload', [RiderController::class, 'upload'])->name('upload');
});

//pizza crud route
Route::group(['prefix' => 'admin/pizzas', 'middleware' => [AdminCheckMiddleware::class], 'as' => 'pizza.'], function () {
    Route::get('/', [PizzaController::class, 'pizzaList'])->name('list');

    Route::get('/create', [PizzaController::class, 'showNewPizzaForm'])->name('create.get');

    Route::post('/create', [PizzaController::class, 'submitNewPizzaForm'])->name('create.post');

    Route::get('/search', [PizzaController::class,'searchPizza'])->name('search.get');

    Route::get('/{id}', [PizzaController::class, 'pizzaDetails'])->name('detail')->where('id','[0-9]+');

    Route::get('/{id}/edit', [PizzaController::class, 'showEditPizzaForm'])->name('edit.get');

    Route::post('/{id}/edit', [PizzaController::class, 'submitEditPizzaForm'])->name('edit.post');

    Route::get('/{id}/delete', [PizzaController::class, 'showDeletePizzaConfirm'])->name('delete.get');

    Route::post('/{id}/delete', [PizzaController::class, 'deletePizza'])->name('delete.post');

    Route::get('/export', [PizzaController::class, 'export'])->name('export');
});


Route::group(['prefix' => 'admin', 'middleware' => [AdminCheckMiddleware::class]], function () {

    Route::get('/profile', [UserController::class, 'showAdminProfile'])->name('admin.profile');

    Route::post('/profile/{id}', [UserController::class, 'submitAdminProfile'])->name('admin.profile.post');

    Route::get('/profile/password', [UserController::class, 'showChangePasswordForm'])->name('admin.password.get');

    Route::post('/profile/password/{id}', [UserController::class, 'submitChangePasswordForm'])->name('admin.password.post');

    Route::get('/graph', [GraphController::class, 'graph'])->name('graph');

    Route::get('/users/{role_id}', [UserController::class, 'getAllUsersList'])->name('users.list');

    Route::get('/users/search/{role}', [UserController::class, 'search'])->name('user.search');

    Route::get('/users/download/{role}', [UserController::class, 'export'])->name('user.download');

    Route::get('/new', [UserController::class, 'newAdminForm'])->name('admin.new');

    Route::post('/new', [UserController::class, 'submitNewAdminForm'])->name('admin.new.post');
});

Route::group(['prefix' => 'admin/orders', 'middleware' => [AdminCheckMiddleware::class], 'as' => 'order.'], function () {
    Route::get('/', [OrderController::class, 'orderList'])->name('list');

    Route::post('/define/rider', [OrderController::class, 'defineRider'])->name('rider');

    Route::get('/{id}', [OrderController::class, 'orderDetail'])->name('detail')->where('id','[0-9]+');

    Route::get('/search', [OrderController::class, 'search'])->name('search');
});

Route::group(['prefix' => 'admin/categories', 'middleware' => [AdminCheckMiddleware::class], 'as' => 'category.'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');

    Route::post('/create', [CategoryController::class, 'store'])->name('store');

    Route::get('/create', [CategoryController::class, 'create'])->name('create');

    Route::post('/{id}/edit', [CategoryController::class, 'update'])->name('update');

    Route::delete('/{id}/delete', [CategoryController::class, 'destroy'])->name('delete');

    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');

    Route::get('/search', [CategoryController::class, 'search'])->name('search');

    Route::get('/export', [CategoryController::class, 'export'])->name('export');

    Route::get('/upload', [CategoryController::class, 'showUploadForm'])->name('upload.get');

    Route::post('/upload', [CategoryController::class, 'upload'])->name('upload');
});


Route::get('/', [CustController::class, 'index'])->name('cust');

Route::get('/pizzas/search', [CustController::class, 'searchPizza'])->name('user.pizza.search');


Route::group(['middleware' => [UserCheckMiddleware::class]], function () {

    Route::get('pizza-detail/{id}', [CustController::class, 'pizzaDetail'])->name('pizzaDeatail');

    Route::get('/cart', [CustController::class, 'cart'])->name('cart');

    Route::post('/contact/mail', [CustController::class, 'contactMail'])->name('contact.mail');

    // User/ user detail and change password
    Route::get('/user', [UserController::class, 'showUserProfile'])->name('user.profile');

    Route::post('/user/{id}', [UserController::class, 'submitAdminProfile'])->name('user.profile.post');

    Route::get('/user/password', [UserController::class, 'showUserChangePasswordForm'])->name('customer.password.get');

    Route::post('/user/password/{id}', [UserController::class, 'submitUserChangePasswordForm'])->name('customer.password.post');
});

// customer route
Route::get('pizza-detail/{id}', [CustController::class, 'pizzaDetail'])->name('pizzaDeatail');
Route::get('/cart', [CustController::class, 'getCart'])->name('cart');
Route::get('/add-item/{id}', [CustController::class, 'getAddToCart']);
Route::get('/minus-item/{id}', [CustController::class, 'minusItem']);
Route::get('/delete-item/{id}', [CustController::class, 'deleteItem']);
Route::get('/session-destroy', [CustController::class, 'sessionDestroy']);
Route::get('order', [CustController::class, 'makeorder']);
Route::get('/order-history/detail/{id}', [CustController::class, 'orderHistoryDetail']);
Route::get('/order-history', [CustController::class, 'orderHistory']);
