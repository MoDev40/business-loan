<?php

use App\Http\Controllers\AccountsReceivableController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'login']);
Route::post('/auth', [UserController::class, 'authenticate'])->name('auth.authenticate');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('/dashboard/customers', CustomerController::class);

Route::resource('/dashboard/loan/receivable', AccountsReceivableController::class);
