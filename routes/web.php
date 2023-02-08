<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->get('/', function () {
    if(auth()->user()->role == 'admin')
    {
        return redirect(RouteServiceProvider::ADMIN_HOME);
    } elseif (auth()->user()->role == 'employee')
    {
        return redirect(RouteServiceProvider::EMPLOYEE_HOME);
    } else {
        Auth::logout();
        return redirect()->route('login');
    }
});

require __DIR__ . '/auth.php';

