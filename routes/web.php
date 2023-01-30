<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class, 'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// General
Route::get('/redirect',[HomeController::class, 'redirect'])->middleware('auth','verified');
// AdminController
Route::get('/view_category',[AdminController::class, 'view_category']);
Route::post('/add_category',[AdminController::class, 'add_category']);
Route::get('/delete_category/{id}',[AdminController::class, 'delete_category']);
Route::get('/view_product',[AdminController::class, 'view_product']);
Route::post('/add_product',[AdminController::class, 'add_product']);
Route::get('/show_products',[AdminController::class, 'show_products']);
Route::get('/delete_product/{id}',[AdminController::class, 'delete_product']);
Route::get('/update_product/{id}',[AdminController::class, 'update_product']);
Route::post('/update_product_confirm/{id}',[AdminController::class, 'update_product_confirm']);
Route::get('/user',[AdminController::class, 'user']);
Route::get('/MakeUser/{id}',[AdminController::class, 'MakeUser']);
Route::get('/MakeAdmin/{id}',[AdminController::class, 'MakeAdmin']);
Route::get('/DeleteUser/{id}',[AdminController::class, 'DeleteUser']);
Route::get('/user_search',[AdminController::class, 'user_search']);







Route::get('/order',[AdminController::class, 'order']);
Route::get('/delivered/{id}',[AdminController::class, 'delivered']);
Route::get('/print_pdf/{id}',[AdminController::class, 'print_pdf']);
Route::get('/send_email/{id}',[AdminController::class, 'send_email']);
Route::post('/send_user_email/{id}',[AdminController::class, 'send_user_email']);
Route::get('/order_search',[AdminController::class, 'order_search']);





//HomeController
Route::get('/product_details/{id}',[HomeController::class, 'product_details']);
Route::post('/add_cart/{id}',[HomeController::class, 'add_cart']);
Route::get('/show_cart',[HomeController::class, 'show_cart']);
Route::get('/remove_cart/{id}',[HomeController::class, 'remove_cart']);
Route::get('/cash_order',[HomeController::class, 'cash_order']);
Route::get('/stripe/{totalPrice}',[HomeController::class, 'stripe']);
Route::post('/stripe/{totalPrice}',[HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/show_order',[HomeController::class, 'show_order']);
Route::get('/remove_order/{id}',[HomeController::class, 'remove_order']);
Route::post('/add_comment/{id}',[HomeController::class, 'add_comment']);
Route::post('/add_reply/{id}',[HomeController::class, 'add_reply']);
// Route::get('/product_search',[HomeController::class, 'product_search']);
Route::get('/all_products',[HomeController::class, 'all_products']);
Route::get('/search_product',[HomeController::class, 'search_product']);
