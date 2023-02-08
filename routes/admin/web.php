<?php

use App\Http\Controllers\Admin\ActionsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/admin')->middleware(['auth', 'role_auth:admin'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::resource('employees', EmployeeController::class);
    Route::resource('customers', CustomersController::class);

    Route::post('customers/{customer}/actions', [ActionsController::class, 'store'])->name('customers.actions');
    Route::PUT('customers/{customer}/actions/{action}/update', [ActionsController::class, 'update'])->name('customers.actions.update');
});




