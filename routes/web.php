<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\GuestController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [GuestController::class, 'index'])
    ->name('guest.index');

Route::get('/guest/create', [GuestController::class, 'create'])
    ->name('guest.create');

Route::post('/guest/store', [GuestController::class, 'store'])
    ->name('guest.store');

Route::get('/guest/{c_id}/{r_id}/show', [GuestController::class, 'show'])
    ->name('guest.show');

Route::post('/guest/pay', [GuestController::class, 'pay'])
    ->name('guest.pay');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/shop/index', [ShopController::class, 'index'])
    ->name('shop.index');
    
Route::get('/shop/create', [ShopController::class, 'create'])
    ->name('shop.create');
    
Route::post('/shop/store', [ShopController::class, 'store'])
    ->name('shop.store');

Route::get('/shop/{id}/edit', [ShopController::class, 'edit'])
    ->name('shop.edit');

Route::post('/shop/{id}/update', [ShopController::class, 'update'])
    ->name('shop.update');

Route::post('/shop/{id}/destroy', [ShopController::class, 'destroy'])
    ->name('shop.destroy');

Route::get('/plan/index', [PlanController::class, 'index'])
    ->name('plan.index');

Route::get('/plan/create', [PlanController::class, 'create'])
    ->name('plan.create');

Route::post('/plan/store', [PlanController::class, 'store'])
    ->name('plan.store');

Route::get('/plan/{id}/edit', [PlanController::class, 'edit'])
    ->name('plan.edit');

Route::post('/plan/{id}/update', [PlanController::class, 'update'])
    ->name('plan.update');

Route::post('/plan/{id}/destroy', [PlanController::class, 'destroy'])
    ->name('plan.destroy');
