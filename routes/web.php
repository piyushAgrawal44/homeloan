<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');

    Route::get('/profile', 'userProfile');
    Route::post('/edit/profile', 'editUserProfile');
});

Route::get('/logout', function () {
    Auth::logout();
    return view('home');
});



Route::get('/newloan', function () {
    return view('newloan');
});


Route::controller(LoanController::class)->group(function () {
    Route::post('/newloan', 'newLoan');
    Route::get('/loan/history', 'loanHistory');
    Route::get('/loan/history/{id}', 'loanDetails');
});



Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard');
    Route::get('/loan/analytics', 'loanAnalytics');
    Route::get('/user/analytics', 'userAnalytics');
    Route::get('/admin/loan/history/{id}', 'loanDetails');
    Route::post('/update/loan', 'updateLoan');

});

