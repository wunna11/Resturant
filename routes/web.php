<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\Table\TableCell;
use PhpParser\Node\Expr\Cast;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\Routing\RouteCompiler;

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

Auth::routes();

// Kitchen Panel
Route::resource('dish', DishController::class);
Route::get('/order', [KitchenController::class, 'index'])->name('kitchen.index');
Route::get('/order/{order}/approve', [KitchenController::class, 'approve'])->name('kitchen.approve');
Route::get('/order/{order}/ready', [KitchenController::class, 'ready'])->name('kitchen.ready');
Route::get('/order/{order}/cancel', [KitchenController::class, 'cancel'])->name('kitchen.cancel');
// serve == done
Route::get('/order/{order}/serve', [OrderController::class, 'serve'])->name('kitchen.serve');

// Cashier
Route::get('/cashier', [CashierController::class, 'cashier'])->name('cashier');

// Category
Route::resource('category', CategoryController::class);

// Table
Route::resource('table', TableController::class);

// Waiter Panel
Route::get('/waiter/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/waiter/order-submit', [OrderController::class, 'submit'])->name('order.submit');

// Search box
Route::get('/search/order', [OrderController::class, 'search'])->name('order.search');