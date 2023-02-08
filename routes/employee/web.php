<?php

use App\Http\Controllers\Employee\ActionsController;
use App\Http\Controllers\Employee\CustomersController;
use App\Http\Controllers\Employee\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/employee')->middleware(['auth', 'role_auth:employee'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::resource('customers', CustomersController::class)->except(['destroy']);

    Route::post('customers/{customer}/actions', [ActionsController::class, 'store'])->name('customers.actions');
    Route::PUT('customers/{customer}/actions/{action}/update', [ActionsController::class, 'update'])->name('customers.actions.update');
});




