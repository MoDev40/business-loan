<?php

use App\Http\Controllers\AccountsPayableController;
use App\Http\Controllers\AccountsPayablePaymentController;
use App\Http\Controllers\AccountsReceivableController;
use App\Http\Controllers\AccountsReceivablePaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
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
Route::resource('/dashboard/suppliers', SupplierController::class);

Route::resource('/dashboard/loan/payable', AccountsPayableController::class);
Route::resource('/dashboard/payment/accounts_payable', AccountsPayablePaymentController::class);

Route::resource('/dashboard/loan/receivable', AccountsReceivableController::class);
Route::resource('/dashboard/payment/accounts_receive', AccountsReceivablePaymentController::class);
